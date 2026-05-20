<?php
  session_start();
  $login = BASE_URL . "/connexion";
  $compteClient = BASE_URL . "/monCompte";

  // Si la session n'existe pas, on bloque l'accès à l'utilisateur
  if (!isset($_SESSION['user_id'])) {
    header("Location: $login");
    exit;
  // Si la session existe, mais que l'utilisateur n'est pas un employe
  } elseif (!isset($_SESSION['user_role'])) {
      header("Location: $compteClient");
      exit;
    
  };
?>

<?php 
  require "databaseLink/staffAccountAvisPost.php";
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
          <h1 class="text-primary fw-bold py-4">Les avis clients</h1>
        </div>

        <div>
          <ol class="list-group list-group">
            <?php foreach ($tousAvis as $avis): ?>
            <li
              class="list-group-item p-3 d-flex mb-4 list-mobile-display"
            >
              <div class="m-1 w-100 list-item-mobile-display">
                <h2 class="fw-bold text-dark">
                  <?= $avis['prenom'] ?> <?=$avis['nom']?>
                </h2>
                <h4 class="text-primary"><?=$avis['created_at']?></h4>
                <p class="m-0 lh-1 text-primary comment-mobile-display">
                  <?=$avis['commentaire']?>           
                </p>
                <p class="mt-2">
                  <?php
                    for ($i = 1; $i <= $avis['stars']; $i++){ 
                  ?>
                    <i class="bi bi-star-fill text-warning"></i>
                  <?php
                    }
                  ?>
                </p>
                
                <div class="d-flex justify-content-start mt-2">
                  <form action="<?= BASE_URL ?>/monCompteEmploye/staffAccountAvisPost" method="post">
                    <input type="hidden" id="reviewToUpdate" name="reviewToUpdate" value=<?= $avis['id'] ?>>
                    <?php if ($avis['status'] === 0): ?>
                      <button
                        type="submit"
                        name="accepteReview"
                        class="btn btn-primary large-button"
                        data-id="<?= $avis['id'] ?>"
                      >
                        Valider
                      </button>     
                    <?php endif; ?>       
                    <?php if ($avis['status'] === 1): ?>
                      <button
                        type="submit"
                        name="hideReview"
                        class="btn btn-danger large-button"
                        data-id="<?= $avis['id'] ?>"
                      >
                        Retirer
                      </button>     
                    <?php endif; ?>    
                  </form>  
                   
                </div>
                
              </div>
              <div class="badge-mobile-display">
                <span class="badge <?= ($avis['status'] !== 0) ? "bg-primary" : "text-bg-badge-waiting"?> rounded-pill">
                  <?= ($avis['status'] !== 0) ? "Validé" : "Non validé"?>
                </span>
              </div>
            </li>
            <?php endforeach; ?>
          </ol>
        </div>
      </div>
    </div>
  </div>


</div>
