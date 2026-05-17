<?php 
  require "databaseLink/staffAccountCommandesPost.php";
?>
<script src="<?= BASE_URL ?>/assets/js/staffAccountCommandes.js"></script>

<div id="staffAccountCommandes" class="staffAccount">
  <div class="container py-5">
    <div class="side-by-side-sidebar">
      <?php require "layout/staffAccountSidebar.php"; ?>

      <div class="w-100">
        <div class="text-left">
          <h1 class="text-primary fw-bold py-4">Les commandes</h1>
        </div>

        <div>
          <ol class="list-group list-group">
            <?php foreach ($commandes as $commande): ?>
            <li
              class="list-group-item p-3 d-flex mb-4 align-items-start"
            >
              <!-- <img src="<?= BASE_URL ?>/assets/pictures/fresh-product-key-point.jpg" class="pic-size-order" /> -->
              <div class="m-1 ms-3 w-100">
                <h2 class="fw-bold">
                  <?= $commande['prenom'] ?> <?=$commande['nom']?> - <?=$commande['date_prestation']?>
                </h2>
                <h3><?=$commande['titre']?></h3>
                <div class="infos-wrapper">
                  <div>
                    <p class="m-0 lh-1"><?=$commande['adresse_livraison']?> </p>
                    <p class="m-0"> <?=$commande['code_postal_livraison']?> <?=$commande['ville_livraison']?></p>
                  </div>
                  <div>
                    <p class="m-0 lh-1"><?=$commande['telephone']?></p>
                    <p class="lh-1 m-0"><?=$commande['email']?></p>
                  </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                  <button
                    type="button"
                    class="btn btn-primary large-button"
                  >
                    Modifier
                  </button>
                  <button
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteOrder"
                    class="btn btn-primary large-button"
                    data-id="<?= $commande['id'] ?>"
                  >
                    Supprimer
                  </button>
                  
                    <button
                      type="button"
                      class="btn btn-primary large-button"
                      style="<?= $commande['status'] === 'annule' ? 'visibility:hidden;' : '' ?>"
                    >
                      Mettre à jour le status
                    </button>
                </div>
                
              </div>
              
              <span class="badge <?= getStatusColor($commande['status']) ?> rounded-pill">
                <?= !empty($commande['status']) ? $commande['status'] : "en attente"?>
              </span>
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
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="row modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body p-3 p-sm-5">
          <button type="button" class="btn-close text-end m-0" data-bs-dismiss="modal" aria-label="Close" onclick=closeDeleteCommandeModal()></button>
          <h1 class="text-center">Motif d'annulation</h1>

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
                if ($_GET['error'] === 'noReasonEnterded') {
                    echo "<p class='text-warning m-0' id='errorDeleteOrder'>Une raison doit être entrée</p>";
                }
              } ?>
              <button
                type="submit"
                name="deleteOrder"
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
