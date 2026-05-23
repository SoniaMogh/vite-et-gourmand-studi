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

  $employeRole = "employe";

  //Récupérer les employés 
  $query = "
    SELECT
      *    
    FROM
      users
    WHERE role = :role
  ";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':role', $employeRole);
  $stmt->execute();

  $employes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="adminAccountEmploye" class="staffAccount">
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
          <h1 class="text-primary fw-bold py-4">Les employés</h1>
        </div>

        <div>
          <ol class="list-group">
            <?php foreach ($employes as $employe): ?>
              <li
                class="list-group-item p-3 d-flex mb-4 list-mobile-display-staff"
              >
                <div class="m-1 w-100 list-item-mobile-display">
                  <h2 class="fw-bold text-dark">
                    <?= $employe['prenom'] ?> <?=$employe['nom']?>
                  </h2>
                  <p class="fw-bold text-dark m-0">
                    <?= $employe['telephone'] ?>
                  </p>
                  <p class="fw-bold text-dark m-0">
                    <?= $employe['email'] ?>
                  </p>
                  <p class="fw-bold text-dark m-0">
                    <?= $employe['adresse'] ?> <?= $employe['code_postal'] ?> <?= $employe['ville'] ?>
                  </p>
                </div>
                <div class="mt-2 list-item-mobile-display">

                  <button
                    type="button"
                    class="btn btn-danger medium-button"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteUserModal<?= $employe['id'] ?>"
                  >
                    Supprimer
                  </button>
                </div>
              </li>
              <!-- MODAL SUPPRESSION -->
              <div
                class="modal fade"
                id="deleteUserModal<?= $employe['id'] ?>"
                tabindex="-1"
                aria-labelledby="deleteUserModalTitle"
                aria-hidden="true"         
              >
                <div class="row modal-dialog modal-xl modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-body p-3 p-sm-5">
                      <h2 class="text-center text-warning" id="deleteUserModalTitle">Etes vous certain de vouloir supprimer cet employé de la liste ? </h2>
                      <div class="d-flex justify-content-center gap-4">
                        <form action="<?= BASE_URL ?>/monCompteAdmin/employesPost" method="post">
                          <input type="hidden" id="employeToDeleteId" name="employeToDeleteId" value=<?= $employe['id'] ?>>
                          <button 
                            class="btn btn-danger medium-button mt-4" 
                            type="submit"
                          >
                            Supprimer
                          </button>
                        </form>

                        <button
                          type="button"
                          class="btn btn-primary medium-button mt-4"
                          data-bs-dismiss="modal"
                        > 
                          Annuler
                        </button>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </ol>
        </div>
      </div>
    </div>
  </div>


</div>
