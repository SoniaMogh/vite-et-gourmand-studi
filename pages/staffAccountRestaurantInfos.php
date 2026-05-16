<?php require __DIR__ . "/databaseLink/staffAccountRestaurantInfosPost.php"; ?>

<div id="staffAccountRestaurantInfos" class="staffAccount">
  <?php if (isset($_GET['success'])) { 
    if ($_GET['success'] === 'saved') {
        echo "<div class='alert alert-success text-center' role='alert'> Les horaires ont bien été modifiés.</div>";
    };
  } ?>
  <div class="container py-5">
    <div class="side-by-side-sidebar">
      <?php require "layout/staffAccountSidebar.php"; ?>
      
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
                  value="<?= substr($horaires['Lundi au Samedi']['morning_opening'], 0, 5) ?>"
                />
              </div>
              <div>
                <label for="weekdayMorningTimeClosing">Fermeture matin</label>
                <input
                  class="form-control m-0"
                  type="time"
                  id="weekdayMorningTimeClosing"
                  name="weekdayMorningTimeClosing"
                  value="<?= substr($horaires['Lundi au Samedi']['morning_closing'], 0, 5) ?>"
                />
              </div>
              <div>
                <label for="weekdayNightTimeOpening">Ouverture après-midi</label>
                <input
                  class="form-control m-0"
                  type="time"
                  id="weekdayNightTimeOpening"
                  name="weekdayNightTimeOpening"
                  value="<?= substr($horaires['Lundi au Samedi']['night_opening'], 0, 5) ?>"
                />
              </div>
              <div>
                <label for="weekdayNightTimeClosing">Fermeture après-midi</label>
                <input
                  class="form-control m-0"
                  type="time"
                  id="weekdayNightTimeClosing"
                  name="weekdayNightTimeClosing"
                  value="<?= substr($horaires['Lundi au Samedi']['night_closing'], 0, 5) ?>"
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
                  value="<?= substr($horaires['Dimanche']['morning_opening'], 0, 5) ?>"
                />
              </div>
              <div>
                <label for="sundayMorningTimeClosing">Fermeture matin</label>
                <input
                  class="form-control m-0"
                  type="time"
                  id="sundayMorningTimeClosing"
                  name="sundayMorningTimeClosing"
                  value="<?= substr($horaires['Dimanche']['morning_closing'], 0, 5) ?>"
                />
              </div>
              <div>
                <label for="sundayNightTimeOpening">Ouverture après-midi</label>
                <input
                  class="form-control m-0"
                  type="time"
                  id="sundayNightTimeOpening"
                  name="sundayNightTimeOpening"
                  value="<?= !empty($horaires['Dimanche']['night_opening']) ? substr($horaires['Dimanche']['night_opening'], 0, 5) : '' ?>"
                />
              </div>
              <div>
                <label for="sundayNightTimeClosing">Fermeture après-midi</label>
                <input
                  class="form-control m-0"
                  type="time"
                  id="sundayNightTimeClosing"
                  name="sundayNightTimeClosing"
                  value="<?= !empty($horaires['Dimanche']['night_closing']) ? substr($horaires['Dimanche']['night_closing'], 0, 5) : '' ?>"
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
