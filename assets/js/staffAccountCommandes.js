document.addEventListener('DOMContentLoaded', function () {
  const urlParams = new URLSearchParams(window.location.search);

  if (urlParams.get('error') === 'noReasonEnterded') {
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

document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('deleteOrder');

  modal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget; // 👈 bouton cliqué
    const id = button.getAttribute('data-id');

    document.getElementById('commandeIdToDelete').value = id;
  });
});
