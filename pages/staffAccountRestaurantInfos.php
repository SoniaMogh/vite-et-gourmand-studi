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

<?php require __DIR__ . "/databaseLink/staffAccountRestaurantInfosPost.php"; ?>

<div id="staffAccountRestaurantInfos" class="staffAccount">
  <?php if (isset($_GET['success'])) { 
    if ($_GET['success'] === 'saved') {
        echo "<div class='alert alert-success text-center' role='alert'> Les horaires ont bien été modifiés.</div>";
    };
  } ?>
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
        <?php require "layout/staffAccountSidebar.php"; ?>
      </div>

      <!-- ---------------- SIDEBAR MOBILE -------------- -->
      <div
        class="offcanvas offcanvas-start d-md-none"
        tabindex="-1"
        id="mobileSidebar"
      >
        <div class="offcanvas-body p-0">

          <?php require "layout/staffAccountSidebar.php"; ?>

        </div>
      </div>
      
      <div class="w-100">
        <div class="card card-corner bg-white me-5 px-12px">
          <div class="text-center">
            <h4 class="text-primary fw-bold py-4">Horaires du restaurant</h4>
          </div>
          <form
            action="<?= BASE_URL ?>/monCompteEmploye/InfosRestaurantPost"
            method="post"
            class="form-display"
          >
            <p class="text-primary">Lundi au samedi</p>
            <div class="mb-3 col-12 signup-wrapper">
              <div>
                <label for="weekdayMorningTimeOpening">Ouverture matin</label>
                <!-- On formate la valeur pour avoir 12:00 au lieu de 12:00:00 (position 0 on prend 5 caractères) -->
                <input
                  class="form-control m-0"
                  type="time"
                  id="weekdayMorningTimeOpening"
                  name="weekdayMorningTimeOpening"
                  value="<?= $horaires['1']['morning_opening'] ?>"
                />
              </div>
              <div>
                <label for="weekdayMorningTimeClosing">Fermeture matin</label>
                <input
                  class="form-control m-0"
                  type="time"
                  id="weekdayMorningTimeClosing"
                  name="weekdayMorningTimeClosing"
                  value="<?= $horaires['1']['morning_closing']?>"
                />
              </div>
              <div>
                <label for="weekdayNightTimeOpening">Ouverture après-midi</label>
                <input
                  class="form-control m-0"
                  type="time"
                  id="weekdayNightTimeOpening"
                  name="weekdayNightTimeOpening"
                  value="<?= $horaires['1']['night_opening']?>"
                />
              </div>
              <div>
                <label for="weekdayNightTimeClosing">Fermeture après-midi</label>
                <input
                  class="form-control m-0"
                  type="time"
                  id="weekdayNightTimeClosing"
                  name="weekdayNightTimeClosing"
                  value="<?= $horaires['1']['night_closing']?>"
                />
              </div>
            </div>

            <p class="text-primary">Dimanche</p>
            <div class="mb-3 col-12 signup-wrapper">
              <div>
                <label for="sundayMorningTimeOpening">Ouverture matin</label>
                <input
                  class="form-control m-0"
                  type="time"
                  id="sundayMorningTimeOpening"
                  name="sundayMorningTimeOpening"
                  value="<?= $horaires['2']['morning_opening']?>"
                />
              </div>
              <div>
                <label for="sundayMorningTimeClosing">Fermeture matin</label>
                <input
                  class="form-control m-0"
                  type="time"
                  id="sundayMorningTimeClosing"
                  name="sundayMorningTimeClosing"
                  value="<?= $horaires['2']['morning_closing']?>"
                />
              </div>
            </div>

            <input
              type="submit"
              value="Sauvegarder"
              class=" btn btn-primary large-button"
            />
          </form>
        </div>
        

      </div>
    </div>
  </div>
</div>
