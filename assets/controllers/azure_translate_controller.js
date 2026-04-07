// Optional (requires Symfony UX Stimulus + an asset pipeline/importmap).
// This controller calls /api/translate with CSRF and updates the target element.
//
// Example usage in Twig:
// <div data-controller="azure-translate"
//      data-azure-translate-endpoint-value="{{ path('app_api_translate') }}"
//      data-azure-translate-csrf-token-value="{{ csrf_token('ajax_translate') }}">
//   <textarea data-azure-translate-target="source"></textarea>
//   <select data-azure-translate-target="to"><option value="en">en</option></select>
//   <button data-action="azure-translate#translate">Translate</button>
//   <div data-azure-translate-target="result"></div>
// </div>

import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  static values = {
    endpoint: String,
    csrfToken: String,
  };

  static targets = ['source', 'to', 'from', 'result'];

  async translate() {
    const text = this.sourceTarget.value || '';
    const to = this.toTarget.value;
    const from = this.hasFromTarget && this.fromTarget.value ? this.fromTarget.value : null;

    this.resultTarget.textContent = '...';

    const res = await fetch(this.endpointValue, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': this.csrfTokenValue,
      },
      body: JSON.stringify({ text, to, from }),
      credentials: 'same-origin',
    });

    const data = await res.json().catch(() => null);
    if (!res.ok) {
      const msg = data && data.message ? data.message : 'Translation failed';
      throw new Error(msg);
    }

    this.resultTarget.textContent = data.translated || '';
  }
}
