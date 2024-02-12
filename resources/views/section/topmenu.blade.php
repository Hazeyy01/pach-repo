<nav class="navbar bg-secondary-subtle">
  <form class="container-fluid justify-content-end">
    <button onclick="onLogout()" class="btn btn-secondary" type="button">Sign Out</button>
  </form>
</nav>
<div class="modal fade" id="popupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="popupModalTitle">Notification</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="popupModalBody"></div>
    </div>
  </div>
</div>
