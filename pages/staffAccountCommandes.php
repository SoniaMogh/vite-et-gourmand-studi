<div id="staffAccountCommandes" class="staffAccount">
  <div class="container py-5">
    <div class="side-by-side-sidebar">
      <?php require "layout/staffAccountSidebar.php"; ?>

      <div class="w-100">
        <div class="text-left">
          <h1 class="text-primary fw-bold py-4">Les commandes</h1>
        </div>

        <div>
          <ol class="list-group list-group">
            <li
              class="list-group-item p-3 d-flex mb-4 align-items-start"
            >
              <img src="<?= BASE_URL ?>/assets/pictures/fresh-product-key-point.jpg" class="pic-size-order" />
              <div class="m-1 ms-3 w-100">
                <h2 class="fw-bold">
                  John Doe - 13/04/2027
                </h2>
                <h3>Conviviale & Gourmand</h3>
                <div class="infos-wrapper">
                  <div>
                    <p class="m-0 lh-1">20 Adresse rue de la rue </p>
                    <p class="m-0"> 83720 Ville</p>
                  </div>
                  <div>
                    <p class="m-0 lh-1">0712345678</p>
                    <p class="lh-1 m-0">John.Doe@adresse.fr</p>
                  </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                  <button
                type="button"
                class="btn btn-primary large-button"
              >
                Détails
              </button>
              <button
                type="button"
                class="btn btn-primary large-button"
              >
                Détails
              </button>
              <button
                type="button"
                class="btn btn-primary large-button"
              >
                Détails
              </button>
                </div>
                
              </div>
              
              <span class="badge text-bg-badge rounded-pill">En Attente</span>
            </li>
            <li
              class="list-group-item d-flex justify-content-between align-items-start"
            >
              <div class="ms-2 me-auto">
                <div class="fw-bold">Subheading</div>
                Content for list item
              </div>
              <span class="badge text-bg-primary rounded-pill">14</span>
            </li>
            <li
              class="list-group-item d-flex justify-content-between align-items-start"
            >
              <div class="ms-2 me-auto">
                <div class="fw-bold">Subheading</div>
                Content for list item
              </div>
              <span class="badge text-bg-primary rounded-pill">14</span>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</div>
