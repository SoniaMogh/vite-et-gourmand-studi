<?php require "databaseLink/staffAccountCommandesPost.php";?>

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
                class="btn btn-primary large-button"
              >
                Supprimer
              </button>
              <button
                type="button"
                class="btn btn-primary large-button"
              >
                Mettre à jour le status
              </button>
                </div>
                
              </div>
              
              <span class="badge text-bg-badge rounded-pill"><?=$commande['status']?></span>
            </li>
            <?php endforeach; ?>
          </ol>
        </div>
      </div>
    </div>
  </div>
</div>
