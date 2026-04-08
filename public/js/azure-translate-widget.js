(function () {
  async function postJson(url, body, csrfToken) {
    const res = await fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
      body: JSON.stringify(body),
      credentials: 'same-origin',
    });

    const data = await res.json().catch(() => null);
    if (!res.ok) {
      const message = data && data.message ? data.message : 'Erreur de traduction.';
      throw new Error(message);
    }

    return data;
  }

  function initWidget(root) {
    const endpoint = root.getAttribute('data-translate-endpoint');
    const csrfToken = root.getAttribute('data-csrf-token');

    const sourceEl = root.querySelector('[data-translate-source]');
    const toEl = root.querySelector('[data-translate-to]');
    const fromEl = root.querySelector('[data-translate-from]');
    const submitEl = root.querySelector('[data-translate-submit]');
    const resultEl = root.querySelector('[data-translate-result]');

    if (!endpoint || !csrfToken || !sourceEl || !toEl || !fromEl || !submitEl || !resultEl) return;

    submitEl.addEventListener('click', async () => {
      const text = sourceEl.value || '';
      const to = toEl.value;
      const from = fromEl.value || null;

      submitEl.disabled = true;
      resultEl.textContent = '...';

      try {
        const data = await postJson(endpoint, { text, to, from }, csrfToken);
        resultEl.textContent = data.translated || '';
      } catch (e) {
        resultEl.textContent = '';
        if (window.AppConfirmModal && typeof window.AppConfirmModal.info === 'function') {
          window.AppConfirmModal.info(e && e.message ? e.message : 'Erreur de traduction.');
        }
      } finally {
        submitEl.disabled = false;
      }
    });
  }

  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-translate-widget]').forEach(initWidget);
  });
})();
