<?php
  session_start();
  $login = BASE_URL . "/connexion";
  $compteEmploye = BASE_URL . "/monCompteEmploye/InfosRestaurant";

  // Si la session n'existe pas, on bloque l'accès à l'utilisateur
  if (!isset($_SESSION['user_id'])) {
    header("Location: $login");
    exit;
  // Si la session existe, et  que l'utilisateur est un employe
  } elseif (isset($_SESSION['user_role'])) {
      header("Location: $compteEmploye");
      exit;
    
  };
?>

<div id="userAccountProfile" class="userAccount">
  <div class="container py-5">
    <div class="side-by-side-sidebar">
      <button
        class="btn btn-dark rounded-0 d-md-none mb-md-3 me-4"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#mobileSidebar"
      >
        ☰
      </button>
      <!-- ---------------- SIDEBAR DESKTOP -------------- -->
      <div class="d-none d-md-block">
        <?php require "layout/userAccountSidebar.php"; ?>
      </div>

      <!-- ---------------- SIDEBAR MOBILE -------------- -->
      <div
        class="offcanvas offcanvas-start d-md-none"
        tabindex="-1"
        id="mobileSidebar"
      >
        <div class="offcanvas-body p-0">

          <?php require "layout/userAccountSidebar.php"; ?>

        </div>
      </div>
      
      <div class="">
        <div class="text-left">
          <h1 class="text-primary fw-bold py-4">Mes commandes</h1>
        </div>

        <div class="menu-card-wrapper">
          <!-- CARD 1 -->
          <div class="card card-corner p-0 bg-white">
            <img
              class="forced-in-div shadow"
              src="<?= BASE_URL ?>/assets/pictures/fresh-product-key-point.jpg"
            />

            <div class="p-4 side-by-side gap-2">
              <div class="menu-info-text">
                <h3 class="m-0">Convivial & Gourmand</h3>
                <p class="text-primary">Partez un repas en famille ou entre amis</p>
                <p class="m-0 fw-bold">
                  13/04/2027
                </p>
                <p class="m-0 fw-bold lh-1">
                  20 Adresse rue de la rue
                </p>
                <p class="m-0 fw-bold lh-1">
                  83720
                </p>
              </div>

              <div class="menu-info-price">
                <p class="mb-0 mt-2">45 €/pers</p>
                <button
                  type="button"
                  class="btn btn-primary medium-button"
                  data-bs-toggle="modal"
                  data-bs-target="#menuModal"
                >
                  Détails
                </button>
              </div>
            </div>
          </div>


          <!-- CARD 2 -->
          <div class="card card-corner p-0 bg-white">
            <img
              class="forced-in-div shadow"
              src="<?= BASE_URL ?>/assets/pictures/fresh-product-key-point.jpg"
            />

            <div class="p-4 side-by-side gap-2">
              <div class="menu-info-text">
                <h3 class="m-0">Convivial & Gourmand</h3>
                <p class="text-primary">Partez un repas en famille ou entre amis</p>
                <p class="m-0 fw-bold">
                  13/04/2027
                </p>
                <p class="m-0 fw-bold lh-1">
                  20 Adresse rue de la rue
                </p>
                <p class="m-0 fw-bold lh-1">
                  83720
                </p>
              </div>

              <div class="menu-info-price">
                <p class="mb-0 mt-2">45 €/pers</p>
                <button
                  type="button"
                  class="btn btn-primary medium-button"
                  data-bs-toggle="modal"
                  data-bs-target="#menuModal"
                >
                  Détails
                </button>
              </div>
            </div>
          </div>
          

        </div>

      </div>
    </div>
  </div>
  <!-- Modal -->
  <div
    class="modal fade"
    id="menuModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="row modal-dialog modal-xl modal-dialog-centered">
      <button type="button" class="btn-close text-end m-0" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-content">
        <div class="modal-body p-3 p-sm-5">
          <h1 class="text-center">Convivial & Gourmand</h1>

          <div class="detailed-menu-card-wrapper">
            <div class="card card-corner p-0 bg-white">
              <img
                class="forced-in-div shadow"
                src="<?= BASE_URL ?>/assets/pictures/fresh-product-key-point.jpg"
              />

              <div class="p-4">
                <div class="menu-info-text">
                  <p>Partagez un repas en famille ou entre amis.</p>
                  <p class="text-primary fw-bold m-0">
                    Réservation 8 jours avant la date.
                  </p>
                  <p class="text-primary">2 personnes minimum</p>
                  <p class="m-0 fst-italic text-primary test">
                    Il reste 9 commandes possibles de ce menu
                  </p>
                  <p class="mb-0 mt-2 text-center">45 €/pers</p>
                </div>
              </div>
            </div>
            <div>
              <div class="card card-corner p-0 bg-white mb-4">
                <div class="p-4 py-5">
                  <div class="menu-info-text">
                    <div id="entrée">
                      <h4 class="text-center text-primary fw-bold">Entrée</h4>
                      <h4 class="text-dark fw-bold mb-2">Bourrata Gourmande</h4>
                      <p class="lh-1 mb-0 ms-4">
                        Burrata crémeuse, tomates anciennes, pesto basilic,
                        roquette, pignons torréfiés
                      </p>
                      <p class="text-primary mb-0 ms-4 lh-1">
                        <i class="bi bi-info-circle text-primary"></i>
                        Allergènes: Lait, fruits à coque (pignons)
                      </p>
                    </div>
                    <div id="Plat-principal" class="mt-4">
                      <h4 class="text-center text-primary fw-bold">Entrée</h4>
                      <h4 class="text-dark fw-bold mb-2">Bourrata Gourmande</h4>
                      <p class="lh-1 mb-0 ms-4">
                        Burrata crémeuse, tomates anciennes, pesto basilic,
                        roquette, pignons torréfiés
                      </p>
                      <p class="text-primary mb-0 ms-4 lh-1">
                        <i class="bi bi-info-circle text-primary"></i>
                        Allergènes: Lait, fruits à coque (pignons)
                      </p>
                    </div>
                    <div id="Dessert" class="mt-4">
                      <h4 class="text-center text-primary fw-bold">Entrée</h4>
                      <h4 class="text-dark fw-bold mb-2">Bourrata Gourmande</h4>
                      <p class="lh-1 mb-0 ms-4">
                        Burrata crémeuse, tomates anciennes, pesto basilic,
                        roquette, pignons torréfiés
                      </p>
                      <p class="text-primary mb-0 ms-4 lh-1">
                        <i class="bi bi-info-circle text-primary"></i>
                        Allergènes: Lait, fruits à coque (pignons)
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row justify-content-center">
              <button
                type="button"
                class="btn btn-primary "
              >
                Commander
              </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
