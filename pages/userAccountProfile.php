<?php
  session_start();
  $login = BASE_URL . "/connexion";

  // Si la session n'existe pas, on bloque l'accès à l'utilisateur
  if (!isset($_SESSION['user_id'])) {
    header("Location: $login");
    exit;
  };
?>

<div id="userAccountProfile" class="userAccount">
  <div class="container py-5">
    <div class="side-by-side-sidebar">
      <?php require "layout/userAccountSidebar.php"; ?>
      
      <div class="profile-account-wrapper">
        <!-------------- INFORMATIONS PERSONNELLES ----------------->
        <div class="card card-corner bg-white me-5 px-12px">
          <div class="text-center">
            <h4 class="text-primary fw-bold py-4">Informations personnelles</h4>
          </div>
          <form
            action="<?= BASE_URL ?>/signupPost"
            method="post"
            class="form-display"
          >
            <div class="mb-3 col-12 signup-wrapper">
              <div>
                <label for="updateName">Nom</label>
                <input
                  class="form-control m-0"
                  type="text"
                  id="updateName"
                  name="updateName"
                  placeholder="John"
                  required
                />
              </div>
              <div>
                <label for="updateSurname">Prénom</label>
                <input
                  class="form-control m-0"
                  type="text"
                  id="updateSurname"
                  name="updateSurname"
                  placeholder="Joe"
                  required
                />
              </div>
            </div>
            <div class="mb-3 col-12">
              <label for="updateTel">Numéro de téléphone</label>
              <input
                class="form-control m-0"
                type="tel"
                id="updateTel"
                name="updateTel"
                placeholder="0612345678"
                pattern="0[1-9]{9}"
                required
              />
            </div>
            <div class="mb-3 col-12">
              <label for="updateEmail">Email</label>
              <input
                class="form-control m-0"
                type="email"
                id="updateEmail"
                name="updateEmail"
                placeholder="email@email.fr"
                required
              />
            </div>
            <div class="mb-3 col-12">
              <label for="updateAdress">Adresse </label>
              <input
                class="form-control m-0"
                type="text"
                id="updateAdress"
                name="updateAdress"
                placeholder="Adresse"
                required
              />
            </div>
            <div class="mb-3 col-12 signup-wrapper">
              <div>
                <label for="updateZIP">Code Postal</label>
                <input
                  class="form-control m-0"
                  type="text"
                  id="updateZIP"
                  name="updateZIP"
                  placeholder="33000"
                  inputmode="numeric"
                  pattern="[0-9]{5}"
                  required
                />
              </div>
              <div>
                <label for="updateCity">Ville</label>
                <input
                  class="form-control m-0"
                  type="text"
                  id="updateCity"
                  name="updateCity"
                  placeholder="Bordeaux"
                  required
                />
              </div>
            </div>
            <div class="col-12">
              <label for="updateBirthday">Date de Naissance</label>
              <input
                class="form-control"
                type="date"
                id="updateBirthday"
                name="updateBirthday"
                required
              />
            </div>

            <input
              type="submit"
              value="Sauvegarder"
              class=" btn btn-primary large-button"
            />
          </form>
        </div>
        
        <div class="p-0">
          <!-------------- DETAILS DE PAYEMENT ----------------->
          <div class="card card-corner bg-white mb-3 px-12px">
            <div class="text-center">
              <h4 class="text-primary fw-bold pt-4 pb-2">Détails de Payement</h4>
            </div>
            <form
              action="<?= BASE_URL ?>/signupPost"
              method="post"
              class="form-display"
            >
              <div class="rounded-0 p-1 border-detail-payment d-flex flex-column w-100">
                <label 
                  for="detailPaymentCardNbr" 
                  class="fw-bold"
                >
                  Numéro de carte
                </label>
                <input 
                  type="text" 
                  class="border-0 m-0"
                  id="detailPaymentCardNbr" 
                  name="detailPaymentCardNbr"
                  placeholder="1234 1234 1234 1234"
                >
              </div>
              
              <div class="side-by-side-card-detail d-flex">
                <div class="rounded-0 p-1 border-detail-payment d-flex flex-column m-0">
                  <label 
                    for="detailPaymentCardNbr" 
                    class="fw-bold "
                  >
                    Expiration
                  </label>
                  <input 
                    type="text" 
                    class="border-0 m-0"
                    id="detailPaymentCardNbr" 
                    name="detailPaymentCardNbr"
                    placeholder="MM/YY"
                  >
                </div>
                <div class="rounded-0 p-1 border-detail-payment d-flex flex-column m-0">
                  <label 
                    for="detailPaymentCardNbr" 
                    class="fw-bold"
                  >
                    CVC
                  </label>
                  <input 
                    type="password" 
                    class="border-0 m-0"
                    id="detailPaymentCardNbr" 
                    name="detailPaymentCardNbr"
                    placeholder="123"
                  >
                </div>
              </div>

              <div class="rounded-0 p-1 mb-3 border-detail-payment d-flex flex-column w-100">
                <label 
                  for="detailPaymentCardNbr" 
                  class="fw-bold"
                >
                  Pays
                </label>
                <input 
                  type="text" 
                  class="border-0 m-0"
                  id="detailPaymentCardNbr" 
                  name="detailPaymentCardNbr"
                  placeholder="France"
                >
              </div>

              <input
                type="submit"
                value="Sauvegarder"
                class=" btn btn-primary large-button"
              />
            </form>
          </div>

          <!-------------- CHANGEMENT DE MOT DE PASSE ----------------->
          <div class="card card-corner bg-white px-12px">
            <div class="text-center">
              <h4 class="text-primary fw-bold p-4 pb-2">Changer de mot de passe</h4>
            </div>

            <form
              action="<?= BASE_URL ?>/signupPost"
              method="post"
              class="form-display"
            >

              <div class="mb-3 col-12">
                <label for="updateTel">Ancien mot de passe</label>
                <input
                  class="form-control m-0"
                  type="tel"
                  id="updateTel"
                  name="updateTel"
                  placeholder="0612345678"
                  pattern="0[1-9]{9}"
                  required
                />
              </div>
              <div class="mb-3 col-12">
                <label for="updateEmail">Nouveau mot de passe</label>
                <input
                  class="form-control m-0"
                  type="email"
                  id="updateEmail"
                  name="updateEmail"
                  placeholder="email@email.fr"
                  required
                />
              </div>

              <input
                type="submit"
                value="Changer"
                class=" btn btn-primary large-button"
              />
            </form>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>
