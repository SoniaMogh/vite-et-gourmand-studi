<?php
  require __DIR__ . "/../config/database.php";
  $login = BASE_URL . "/connexion";
  $compteEmploye = BASE_URL . "/monCompteEmploye/InfosRestaurant";

  // Si la session n'existe pas, on bloque l'accès à l'utilisateur
  if (!isset($_SESSION['user_id'])) {
    header("Location: $login");
    exit;
  // Si la session existe et que l'utilisateur est un employe
  } elseif (isset($_SESSION['user_role'])) {
      header("Location: $compteEmploye");
      exit;
    
  };

  //Récupérer l'utilisateur
  $query = "
    SELECT * 
    FROM users
    WHERE id = :id
  ";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':id', $_SESSION['user_id']);
  $stmt->execute();

  $datas = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div id="userAccountProfile" class="userAccount">
  <div class="container py-5">
    <?php if (isset($_GET['success'])) { 
      if ($_GET['success'] === 'saved') {
        echo "<div
          class='alert alert-success text-center' role='alert'>Vos modifications ont bien été prit en compte
        </div>";
      }
    } ?>
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
        
      <div class="profile-account-wrapper">

        <!-------------- INFORMATIONS PERSONNELLES ----------------->
        <div class="card card-corner bg-white me-5 px-12px">
          <div class="text-center">
            <h4 class="text-primary fw-bold py-4">Informations personnelles</h4>
          </div>
          <form
            action="<?= BASE_URL ?>/monComptePost"
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
                  value= <?= $datas['nom'] ?>
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
                  value= <?= $datas['prenom'] ?>
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
                value= <?= $datas['telephone'] ?>
                pattern="0[0-9]{9}"
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
                value= <?= $datas['email'] ?>
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
                value= <?= $datas['adresse'] ?>
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
                  value= <?= $datas['code_postal'] ?>
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
                  value= <?= $datas['ville'] ?>
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
                value= <?= $datas['birthday'] ?>
                required
              />
            </div>

            <input
              type="submit"
              value="Sauvegarder"
              name="updatePersonalInfos"
              class=" btn btn-primary large-button"
            />
          </form>
        </div>
        
        <div class="p-0">
          <!-------------- DETAILS DE PAYEMENT (PAS DE LOGIQUE DERRIERE) ----------------->
          <div class="card card-corner bg-white mb-3 px-12px">
            <div class="text-center">
              <h4 class="text-primary fw-bold pt-4 pb-2">Détails de Payement</h4>
            </div>
            <form
              action="<?= BASE_URL ?>/monComptePost"
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
                  name="detailPaymentCardNbr"
                  placeholder="1234 1234 1234 1234"
                  required
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
                    name="detailPaymentCardNbr"
                    placeholder="MM/YY"
                    required
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
                    name="detailPaymentCardNbr"
                    placeholder="123"
                    required
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
                  name="detailPaymentCardNbr"
                  placeholder="France"
                  required
                >
              </div>

              <input
                type="submit"
                name="updateDetailPayment"
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
              action="<?= BASE_URL ?>/monComptePost"
              method="post"
              class="form-display"
            >

              <div class="mb-3 col-12">
                <label for="oldPasswordToUpdate">Ancien mot de passe</label>
                <input
                  class="form-control m-0"
                  type="password"
                  id="oldPasswordToUpdate"
                  name="oldPasswordToUpdate"
                  minlength="10"
                  pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{10,}"
                  placeholder="******"
                  required
                />
              </div>
              <div class="mb-3 col-12">
                <label for="newPasswordToUpdate">Nouveau mot de passe</label>
                <input
                  class="form-control m-0"
                  type="password"
                  id="newPasswordToUpdate"
                  name="newPasswordToUpdate"
                  minlength="10"
                  pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{10,}"
                  placeholder="******"
                  required
                />
              </div>

              <input
                type="submit"
                value="Changer"
                name="changePassword"
                class=" btn btn-primary large-button"
              />
            </form>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>
