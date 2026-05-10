(function () {
  function initBulkForm(form) {
    const formId = form.getAttribute('id');
    if (!formId) return;

    const selectAll =
      document.querySelector(`.js-bulk-select-all[data-bulk-form-id="${formId}"]`) ||
      form.querySelector('.js-bulk-select-all');

    const items = Array.from(document.querySelectorAll(`.js-bulk-item[form="${formId}"]`));

    function enabledItems() {
      return items.filter((i) => !i.disabled);
    }

    function selectedItems() {
      return enabledItems().filter((i) => i.checked);
    }

    function refreshSelectAllState() {
      if (!selectAll) return;
      const enabled = enabledItems();
      const selected = selectedItems();

      if (enabled.length === 0) {
        selectAll.checked = false;
        selectAll.indeterminate = false;
        selectAll.disabled = true;
        return;
      }

      selectAll.disabled = false;
      selectAll.checked = selected.length === enabled.length;
      selectAll.indeterminate = selected.length > 0 && selected.length < enabled.length;
    }

    if (selectAll) {
      selectAll.addEventListener('change', () => {
        const enabled = enabledItems();
        enabled.forEach((checkbox) => {
          checkbox.checked = selectAll.checked;
        });
        refreshSelectAllState();
      });
    }

    items.forEach((checkbox) => {
      checkbox.addEventListener('change', refreshSelectAllState);
    });

    form.addEventListener('submit', (e) => {
      const selected = selectedItems();
      if (selected.length === 0) {
        e.preventDefault();
        if (window.AppConfirmModal && typeof window.AppConfirmModal.info === 'function') {
          const msg =
            (window.AppI18n && window.AppI18n.emptySelectionMessage) ||
            'Veuillez sélectionner au moins un élément.';
          window.AppConfirmModal.info(msg);
        }
        return;
      }

      const submitter = e.submitter || document.activeElement;
      const message =
        (submitter && submitter.getAttribute && submitter.getAttribute('data-confirm-message')) ||
        ((window.AppI18n && window.AppI18n.bulkConfirmCountMessage)
          ? String(window.AppI18n.bulkConfirmCountMessage).replace('%count%', String(selected.length))
          : `Confirmer la suppression de ${selected.length} élément(s) ?`);

      e.preventDefault();
      if (window.AppConfirmModal && typeof window.AppConfirmModal.confirm === 'function') {
        window.AppConfirmModal.confirm(message, function () {
          form.submit();
        });
      }
    });

    refreshSelectAllState();
  }

  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('form[data-bulk-form]').forEach(initBulkForm);
  });
})();
