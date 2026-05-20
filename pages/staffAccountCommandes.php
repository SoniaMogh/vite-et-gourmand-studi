
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
  require "databaseLink/staffAccountCommandesPost.php";
?>
<script src="<?= BASE_URL ?>/assets/js/staffAccountCommandes.js"></script>

<div id="staffAccountCommandes" class="staffAccount">
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
          <h1 class="text-primary fw-bold py-4">Les commandes</h1>
        </div>

        <div>
          <ol class="list-group list-group">
            <?php foreach ($commandes as $commande): ?>
            <li
              class="list-group-item p-3 d-flex mb-4 align-items-start gap-3 list-mobile-display"
            >
              <div class="m-1 ms-md-3 w-100 list-item-mobile-display">
                <h2 class="fw-bold comment-mobile-display">
                  <?= $commande['prenom'] ?> <?=$commande['nom']?> - <?=$commande['date_prestation']?>
                </h2>
                <h3><?=$commande['titre']?></h3>
                <div class="infos-wrapper">
                  <div>
                    <p class="m-0 lh-1 text-center"><?=$commande['adresse_livraison']?> </p>
                    <p class="m-0 text-center"> <?=$commande['code_postal_livraison']?> <?=$commande['ville_livraison']?></p>
                  </div>
                  <div>
                    <p class="m-0 lh-1 text-center"><?=$commande['telephone']?></p>
                    <p class="lh-1 m-0 text-center"><?=$commande['email']?></p>
                  </div>
                </div>
                <div class="d-flex flex-column flex-sm-row flex-wrap gap-2">

                  <?php if ($commande['status'] !== 'annule'): ?>
                    <button
                      type="button"
                      data-bs-toggle="modal"
                      data-bs-target="#deleteOrder"
                      class="btn btn-primary large-button mt-4 mt-lg-0 me-3 me-lg-5"
                      data-id="<?= $commande['id'] ?>"
                    >
                      Supprimer
                    </button>   
                  <?php endif; ?>               
                   <?php if ($commande['status'] !== 'annule' && !empty($commande['status']) && $commande['status'] !== 'terminee'): ?>
                    <form action="<?= BASE_URL ?>/monCompteEmploye/commandesPost" method="post">
                      <input type="hidden" id="orderTrackingToUpdate" name="orderTrackingToUpdate" value=<?= $commande['id'] ?>>
                      <button
                        type="submit" 
                        name="changeStatusOrderbtn"
                        class="btn btn-primary large-button"
                      >
                        Mettre à jour le status
                      </button>
                    <?php endif; ?>
                    </form>
                    <?php if (empty($commande['status'])): ?>
                    <form action="<?= BASE_URL ?>/monCompteEmploye/accepteCommandesPost" method="post">
                      <input type="hidden" name="orderTrackingAccepte"
                        value=<?= $commande['id'] ?>>
                      <button
                        type="submit"
                        name="accepteOrderbtn"
                        class="btn btn-primary large-button"
                      >
                        Accepter
                      </button>
                    </form>
                    <?php endif; ?>
                </div>
                
              </div>
              <div class="badge-mobile-display">
              <span class="badge <?= getStatusColor($commande['status']) ?> rounded-pill">
                <?= !empty($commande['status']) ? getStatusName($commande['status']) : "En attente"?>
              </span>
              </div>
            </li>
            <?php endforeach; ?>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Order Modal -->
  <div
    class="modal fade"
    id="deleteOrder"
    tabindex="-1"
    aria-labelledby="motifAnnulationTitle"
    aria-hidden="true"
  >
    <div class="row modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body p-3 p-sm-5">
          <button type="button" class="btn-close text-end m-0" data-bs-dismiss="modal" aria-label="Close" onclick=closeDeleteCommandeModal()></button>
          <h1 class="text-center" id="motifAnnulationTitle">Motif d'annulation</h1>

          <div class="card card-corner p-0 bg-white">
            <form
              action="<?= BASE_URL ?>/monCompteEmploye/commandesPost"
              method="post"
              class="form-display"
            >
              <div class="col-12">
                <label for="wayOfContactToDelete">Moyen de contact</label>
                <select 
                  name="wayOfContactToDelete" 
                  id="wayOfContactToDelete" 
                  class="mb-2 form-control text-primary"
                  required
                >
                  <option value="appel">Appel téléphonique</option>
                  <option value="mail">Mail</option>
                </select>
              </div>
              <div class="col-12">
                <label for="reasonToDelete">Raison de la suppresion</label>

                <textarea
                  class="form-control m-0 text-primary"
                  id="reasonToDelete"
                  name="reasonToDelete"
                  placeholder="Veuillez entrer la raison de la suppression de la commande"
                  required
                ></textarea>
              </div>
              <?php if (isset($_GET['error'])) { 
                if ($_GET['error'] === 'noReasonEntered') {
                    echo "<p class='text-warning m-0' id='errorDeleteOrder'>Une raison doit être entrée</p>";
                }
              } ?>
              <button
                type="submit"
                name="deleteOrderbtn"
                class="btn btn-primary large-button m-4 text-white"
              >Supprimer</button>
              <input type="hidden" id="commandeIdToDelete" name="commandeIdToDelete">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>
