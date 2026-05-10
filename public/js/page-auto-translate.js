(function () {
  const MAX_BATCH_SIZE = 250;
  const CACHE_VERSION = 'v1';
  const SKIP_TAGS = new Set(['SCRIPT', 'STYLE', 'NOSCRIPT', 'CODE', 'PRE', 'TEXTAREA', 'OPTION']);

  function normalizeText(text) {
    return String(text || '').replace(/\s+/g, ' ').trim();
  }

  function hasLetters(text) {
    return /[A-Za-z\u00C0-\u024F\u0600-\u06FF]/.test(text);
  }

  function isTranslatableText(text) {
    const value = normalizeText(text);
    if (!value) return false;
    if (value.length < 2 || value.length > 160) return false;
    if (!hasLetters(value)) return false;
    if (/^https?:\/\//i.test(value)) return false;
    if (/^[0-9\s.,:;/%()\-+]+$/.test(value)) return false;

    return true;
  }

  function shouldSkipElement(el) {
    if (!el) return true;
    if (el.closest('[data-no-auto-translate]')) return true;
    if (SKIP_TAGS.has(el.tagName)) return true;

    return false;
  }

  function canTranslateAttribute(el, attrName) {
    if (attrName !== 'value') {
      return true;
    }

    if (el.tagName !== 'INPUT') {
      return false;
    }

    const type = (el.getAttribute('type') || '').toLowerCase();
    return type === 'button' || type === 'submit' || type === 'reset';
  }

  function readCache(key) {
    try {
      const raw = window.localStorage.getItem(key);
      if (!raw) return {};

      const parsed = JSON.parse(raw);
      if (!parsed || typeof parsed !== 'object') return {};

      return parsed;
    } catch (_e) {
      return {};
    }
  }

  function writeCache(key, value) {
    try {
      window.localStorage.setItem(key, JSON.stringify(value));
    } catch (_e) {
      // Ignore storage quota and private mode errors.
    }
  }

  async function requestBatchTranslation(endpoint, csrfToken, toLocale, texts) {
    const response = await fetch(endpoint, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
      credentials: 'same-origin',
      body: JSON.stringify({
        texts: texts,
        to: toLocale,
      }),
    });

    const data = await response.json().catch(function () {
      return null;
    });

    if (!response.ok) {
      const message = data && data.message ? data.message : 'Automatic translation failed.';
      throw new Error(message);
    }

    if (!data || typeof data !== 'object' || typeof data.translations !== 'object') {
      return {};
    }

    return data.translations;
  }

  function collectBindings(root) {
    const bindings = [];
    const keys = new Set();

    const walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT);
    let node = walker.nextNode();
    while (node) {
      const parent = node.parentElement;
      const raw = node.nodeValue || '';

      if (!shouldSkipElement(parent) && isTranslatableText(raw)) {
        const key = normalizeText(raw);
        const leading = raw.match(/^\s*/);
        const trailing = raw.match(/\s*$/);

        bindings.push({
          type: 'text',
          node: node,
          key: key,
          leading: leading ? leading[0] : '',
          trailing: trailing ? trailing[0] : '',
        });

        keys.add(key);
      }

      node = walker.nextNode();
    }

    const attrs = ['placeholder', 'title', 'aria-label', 'value'];
    const elements = root.querySelectorAll('[placeholder], [title], [aria-label], input[value]');
    elements.forEach(function (el) {
      if (shouldSkipElement(el)) return;

      attrs.forEach(function (attrName) {
        if (!el.hasAttribute(attrName)) return;
        if (!canTranslateAttribute(el, attrName)) return;

        const raw = el.getAttribute(attrName) || '';
        if (!isTranslatableText(raw)) return;

        const key = normalizeText(raw);

        bindings.push({
          type: 'attr',
          el: el,
          attrName: attrName,
          key: key,
        });

        keys.add(key);
      });
    });

    return {
      bindings: bindings,
      keys: Array.from(keys),
    };
  }

  function applyBindings(bindings, dictionary) {
    bindings.forEach(function (binding) {
      const translated = dictionary[binding.key];
      if (typeof translated !== 'string' || translated === '') {
        return;
      }

      if (binding.type === 'text') {
        binding.node.nodeValue = binding.leading + translated + binding.trailing;
        return;
      }

      if (binding.type === 'attr') {
        binding.el.setAttribute(binding.attrName, translated);
      }
    });
  }

  function buildState(body, locale) {
    const cacheKey = 'auto.translate.' + CACHE_VERSION + '.' + locale;

    return {
      locale: locale,
      endpoint: body.getAttribute('data-auto-translate-endpoint') || '',
      csrfToken: body.getAttribute('data-auto-translate-csrf') || '',
      cacheKey: cacheKey,
      cache: readCache(cacheKey),
      running: false,
      pending: false,
      timerId: null,
      observer: null,
    };
  }

  async function translateDom(state, root) {
    if (state.running) {
      state.pending = true;
      return;
    }

    state.running = true;

    try {
      const collected = collectBindings(root);
      const bindings = collected.bindings;
      const keys = collected.keys;

      if (bindings.length === 0) {
        return;
      }

      // Apply already cached translations immediately.
      applyBindings(bindings, state.cache);

      const missing = keys.filter(function (key) {
        return typeof state.cache[key] !== 'string' || state.cache[key] === '';
      }).slice(0, MAX_BATCH_SIZE);

      if (missing.length === 0) {
        return;
      }

      const batchTranslations = await requestBatchTranslation(state.endpoint, state.csrfToken, state.locale, missing);

      Object.keys(batchTranslations).forEach(function (sourceText) {
        const translated = batchTranslations[sourceText];
        if (typeof translated === 'string' && translated !== '') {
          state.cache[sourceText] = translated;
        }
      });

      writeCache(state.cacheKey, state.cache);
      applyBindings(bindings, state.cache);
    } catch (error) {
      // Keep page usable if translation provider is unavailable.
      if (window.console && typeof window.console.warn === 'function') {
        window.console.warn('[auto-translate]', error && error.message ? error.message : error);
      }
    } finally {
      state.running = false;
      if (state.pending) {
        state.pending = false;
        window.setTimeout(function () {
          translateDom(state, document.body);
        }, 120);
      }
    }
  }

  function observeDom(state) {
    if (!window.MutationObserver || !document.body) {
      return;
    }

    state.observer = new MutationObserver(function (mutations) {
      if (!mutations || mutations.length === 0) {
        return;
      }

      const shouldProcess = mutations.some(function (mutation) {
        return mutation.type === 'childList' || mutation.type === 'attributes';
      });

      if (!shouldProcess) {
        return;
      }

      if (state.timerId) {
        window.clearTimeout(state.timerId);
      }

      state.timerId = window.setTimeout(function () {
        translateDom(state, document.body);
      }, 200);
    });

    state.observer.observe(document.body, {
      childList: true,
      subtree: true,
      attributes: true,
      attributeFilter: ['placeholder', 'title', 'aria-label', 'value'],
    });
  }

  function initAutoTranslation() {
    const body = document.body;
    if (!body) {
      return;
    }

    const locale = String(body.getAttribute('data-auto-translate-locale') || document.documentElement.lang || 'fr').toLowerCase();
    if (locale.startsWith('fr')) {
      return;
    }

    const state = buildState(body, locale);
    if (!state.endpoint || !state.csrfToken) {
      return;
    }

    translateDom(state, document.body);
    observeDom(state);
  }

  document.addEventListener('DOMContentLoaded', initAutoTranslation);
})();
