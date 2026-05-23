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

<div id="adminAccountDashboard" class="staffAccount">
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

      <div id="page-in-construction">
        <div>
          <h1>Cette page est en cours de construction</h1>
          <p>Nous sommes désolé pour la gène occasionnée</p>
        </div>
      </div>
    </div>
  </div>
</div>