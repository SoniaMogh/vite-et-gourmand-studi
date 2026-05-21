<?php
  require __DIR__ . "/../config/database.php";
  $login = BASE_URL . "/connexion";
  $compteClient = BASE_URL . "/monCompte";
  $compteEmploye = BASE_URL . "/monCompteEmploye/InfosRestaurant";

  // Si la session n'existe pas, on bloque l'accès à l'utilisateur
  if (!isset($_SESSION['user_id'])) {
    header("Location: $login");
    exit;
  // Si la session existe mais que l'utilisateur est un client
  } elseif (!isset($_SESSION['user_role'])) {
    header("Location: $compteClient");
    exit;

    // Si la session existe mais que l'utilisateur n'est pas un admin
  } elseif ($_SESSION['user_role'] !== "admin") {
    header("Location: $compteEmploye");
    exit;
  };
?>

<div id="staffAccountAvis" class="staffAccount">
  <div class="container py-5">
    <div class="side-by-side-sidebar">
      <button
        class="btn btn-dark rounded-0 d-md-none mb-md-3 me-4 my-4"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#mobileSidebar"
      >
        ☰
      </button>
      <!-- ---------------- SIDEBAR DESKTOP -------------- -->
      <div class="d-none d-md-block">
        <?php 
          if ($_SESSION['user_role'] === "admin") {
            require "layout/adminAccountSidebar.php"; 
          } else {
            require "layout/staffAccountSidebar.php"; 
          }
        ?>
      </div>

      <!-- ---------------- SIDEBAR MOBILE -------------- -->
      <div
        class="offcanvas offcanvas-start d-md-none"
        tabindex="-1"
        id="mobileSidebar"
      >
        <div class="offcanvas-body p-0">

          <?php 
            if ($_SESSION['user_role'] === "admin") {
              require "layout/adminAccountSidebar.php"; 
            } else {
              require "layout/staffAccountSidebar.php"; 
            }
          ?>

        </div>
      </div>
        

      <div class="w-100">
        <div class="text-left">
          <h1 class="text-primary fw-bold py-4">Créer un compte employé</h1>
        </div>

        <div class="card py-5 p-xl-5 card-corner">

          <form
            action="<?= BASE_URL ?>/signupPost"
            method="post"
            class="form-display"
          >
            <div class="mb-2 col-12 signup-wrapper">
              <input
                class="form-control m-0"
                type="text"
                id="signupName"
                name="signupName"
                placeholder="Nom"
                required
              />
              <input
                class="form-control m-0"
                type="text"
                id="signupSurname"
                name="signupSurname"
                placeholder="Prénom"
                required
              />
            </div>
            <div class="mb-2 col-12">
              <input
                class="form-control m-0"
                type="tel"
                id="signupTel"
                name="signupTel"
                placeholder="Numéro de téléphone"
                pattern="0[0-9]{9}"
                required
              />
            </div>
            <div class="mb-2 col-12">
              <?php if (isset($_GET['error'])) { 
              if ($_GET['error'] === 'emailAlreadyExist') {
                  echo "<p class='text-warning m-0'>Cette adresse email existe déjà.</p>";
              }
            } ?>
              <input
                class="form-control m-0"
                type="email"
                id="signupEmail"
                name="signupEmail"
                placeholder="Email"
                required
              />
            </div>
            <div class="mb-2 col-12">
              <input
                class="form-control m-0"
                type="text"
                id="signupAdress"
                name="signupAdress"
                placeholder="Adresse"
                required
              />
            </div>
            <div class="mb-2 col-12 signup-wrapper">
              <input
                class="form-control m-0"
                type="text"
                id="signupZIP"
                name="signupZIP"
                placeholder="Code postal"
                inputmode="numeric"
                pattern="[0-9]{5}"
                required
              />
              <input
                class="form-control m-0"
                type="text"
                id="signupCity"
                name="signupCity"
                placeholder="Ville"
                required
              />
            </div>
            <div class="mb-2 col-12 d-flex align-items-center gap-2">
              <input
                class="form-control m-0"
                type="password"
                id="signupPassword"
                name="signupPassword"
                placeholder="Mot de passe"
                autocomplete="new-password"
                minlength="10"
                pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{10,}"
                required
              /> 
              <i 
                class="bi bi-question-circle" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top"
                data-bs-html="true"
                title="Votre mot de passe doit contenir: au moins 10 caractères dont un caractère spécial, une majuscule, une minuscule et un chiffre."
              >
              </i>
            </div>
            <div class="col-12">
              <input
                class="form-control

                <?php if (isset($_GET['error'])) { 
                  if ($_GET['error'] === 'mdpNotConfirmed') {
                      echo "m-0";
                  }
                } ?>
                
                "
                type="password"
                id="signupCheckPassword"
                name="signupCheckPassword"
                placeholder="Confirmer le mot de Passe"
                required
              />
            </div>
            <!-- message d'erreur si le mdp ne correspond pas à la confirmation -->
            <?php if (isset($_GET['error'])) { 
              if ($_GET['error'] === 'mdpNotConfirmed') {
                  echo "<p class='text-warning m-0'>Votre mot de passe ne correspond pas.</p>";
              }
            } ?>
            <input type="hidden" name="role" value="employe">

            <input
              type="submit"
              value="Créer"
              class="mb-0 mt-4 btn btn-primary large-button"
            />
          </form>
        </div>
      </div>
    </div>
  </div>


</div>
