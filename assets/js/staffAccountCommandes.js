document.addEventListener('DOMContentLoaded', function () {
  const urlParams = new URLSearchParams(window.location.search);

  if (urlParams.get('error') === 'noReasonEntered') {
    const modalEl = document.getElementById('deleteOrder');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
  }
});

function closeDeleteCommandeModal() {
  const url = new URL(window.location);
  url.searchParams.delete('error');

  window.history.replaceState({}, document.title, url.toString());
  const errorEl = document.getElementById('errorDeleteOrder');
  if (errorEl) {
    errorEl.remove();
  }
}

function giveCommmandeId(modalId, hiddenInputId) {
  document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById(modalId);

    modal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const id = button.getAttribute('data-id');

      document.getElementById(hiddenInputId).value = id;
    });
  });
}

giveCommmandeId('deleteOrder', 'commandeIdToDelete');
giveCommmandeId('changeStatusOrder', 'orderTrackingToUpdate');
