(function () {
  'use strict';

  // Escape HTML to prevent XSS
  function escapeHtml(text) {
    const map = {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#039;',
    };
    return text.replace(/[&<>"']/g, (m) => map[m]);
  }

  // Load messages from localStorage
  function loadMessages() {
    try {
      const stored = localStorage.getItem('chatbot_messages');
      return stored ? JSON.parse(stored) : getInitialMessages();
    } catch (e) {
      console.warn('Could not load messages from localStorage:', e);
      return getInitialMessages();
    }
  }

  // Save messages to localStorage
  function saveMessages(messages) {
    try {
      localStorage.setItem('chatbot_messages', JSON.stringify(messages));
    } catch (e) {
      console.warn('Could not save messages to localStorage:', e);
    }
  }

  // Get initial welcome message
  function getInitialMessages() {
    return [
      {
        type: 'bot',
        content: 'Hello! 👋 I\'m your agricultural assistant. How can I help you with farming, crops, soil, irrigation, or equipment today?',
        timestamp: new Date().toISOString(),
      },
    ];
  }

  // Create HTML for a message
  function createMessageElement(msg) {
    const timestamp = new Date(msg.timestamp);
    const timeStr = timestamp.toLocaleTimeString('en-US', {
      hour: 'numeric',
      minute: '2-digit',
      hour12: true,
    });

    const errorClass = msg.isError ? ' error' : '';
    const messageClass = `message message-${msg.type}${errorClass}`;

    return `
      <div class="${messageClass}">
        <div class="message-bubble">
          ${escapeHtml(msg.content)}
        </div>
        <div class="message-time">${timeStr}</div>
      </div>
    `;
  }

  // Render all messages
  function renderMessages(messagesContainer, messages) {
    messagesContainer.innerHTML = messages
      .map((msg) => createMessageElement(msg))
      .join('');
  }

  // Scroll messages to bottom
  function scrollToBottom(messagesContainer) {
    setTimeout(() => {
      messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }, 10);
  }

  // Initialize chatbot widget
  function initChatbot(root) {
    const endpoint = root.getAttribute('data-chatbot-endpoint-value');
    const csrfToken = root.getAttribute('data-chatbot-csrf-token-value');

    if (!endpoint || !csrfToken) {
      console.error('Chatbot: Missing endpoint or CSRF token');
      return;
    }

    // Get DOM elements
    const toggleBtn = root.querySelector('.chatbot-toggle');
    const widget = root.querySelector('.chatbot-widget');
    const closeBtn = root.querySelector('.chatbot-close');
    const messagesContainer = root.querySelector('[data-chatbot-target="messages"]');
    const messageInput = root.querySelector('[data-chatbot-target="message"]');
    const sendBtn = root.querySelector('[data-chatbot-target="send"]');
    const loader = root.querySelector('[data-chatbot-target="loader"]');
    const clearBtn = root.querySelector('.chatbot-clear-btn');

    if (!toggleBtn || !widget || !closeBtn || !messagesContainer || !messageInput || !sendBtn || !loader) {
      console.error('Chatbot: Missing required DOM elements');
      return;
    }

    // Load messages
    let messages = loadMessages();
    renderMessages(messagesContainer, messages);

    // Toggle widget visibility
    function toggleWidget() {
      widget.classList.toggle('chatbot-open');
      if (widget.classList.contains('chatbot-open')) {
        setTimeout(() => messageInput.focus(), 300);
        scrollToBottom(messagesContainer);
      }
    }

    // Close widget
    function closeWidget() {
      widget.classList.remove('chatbot-open');
    }

    // Clear history
    function clearHistory() {
      if (confirm('Are you sure you want to clear the conversation history?')) {
        messages = getInitialMessages();
        saveMessages(messages);
        renderMessages(messagesContainer, messages);
        scrollToBottom(messagesContainer);
      }
    }

    // Send message
    async function sendMessage(event) {
      event?.preventDefault?.();

      const message = messageInput.value.trim();
      if (!message) return;

      // Add user message
      messages.push({
        type: 'user',
        content: message,
        timestamp: new Date().toISOString(),
      });

      // Clear input and render
      messageInput.value = '';
      renderMessages(messagesContainer, messages);
      scrollToBottom(messagesContainer);

      // Show loader
      loader.classList.add('visible');
      sendBtn.disabled = true;
      messageInput.disabled = true;

      try {
        const response = await fetch(endpoint, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
          },
          body: JSON.stringify({ message }),
          credentials: 'same-origin',
        });

        const data = await response.json().catch(() => null);

        if (!response.ok) {
          const errorMsg = data?.error || 'An error occurred. Please try again.';
          messages.push({
            type: 'bot',
            content: errorMsg,
            timestamp: new Date().toISOString(),
            isError: true,
          });
        } else if (data && data.success && data.response) {
          messages.push({
            type: 'bot',
            content: data.response,
            timestamp: new Date().toISOString(),
          });
        } else {
          messages.push({
            type: 'bot',
            content: 'Unable to process response. Please try again.',
            timestamp: new Date().toISOString(),
            isError: true,
          });
        }
      } catch (error) {
        console.error('Chatbot error:', error);
        messages.push({
          type: 'bot',
          content: 'Network error. Please check your connection and try again.',
          timestamp: new Date().toISOString(),
          isError: true,
        });
      } finally {
        // Hide loader
        loader.classList.remove('visible');
        sendBtn.disabled = false;
        messageInput.disabled = false;
        saveMessages(messages);
        renderMessages(messagesContainer, messages);
        scrollToBottom(messagesContainer);
        messageInput.focus();
      }
    }

    // Event listeners
    toggleBtn.addEventListener('click', toggleWidget);
    closeBtn.addEventListener('click', closeWidget);
    sendBtn.addEventListener('click', sendMessage);
    if (clearBtn) clearBtn.addEventListener('click', clearHistory);

    // Handle Enter key
    messageInput.addEventListener('keydown', (event) => {
      if (event.key === 'Enter' && !event.shiftKey) {
        event.preventDefault();
        sendMessage();
      }
    });
  }

  // Initialize on DOM ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('[data-controller="chatbot"]').forEach(initChatbot);
    });
  } else {
    document.querySelectorAll('[data-controller="chatbot"]').forEach(initChatbot);
  }
})();
