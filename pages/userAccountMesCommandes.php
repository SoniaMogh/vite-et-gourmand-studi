<?php
  session_start();
  $login = BASE_URL . "/connexion";
  $compteEmploye = BASE_URL . "/monCompteEmploye/InfosRestaurant";

  // Si la session n'existe pas, on bloque l'accès à l'utilisateur
  if (!isset($_SESSION['user_id'])) {
    header("Location: $login");
    exit;
  // Si la session existe, et  que l'utilisateur est un employe
  } elseif (isset($_SESSION['user_role'])) {
      header("Location: $compteEmploye");
      exit;
    
  };

  function getStatusColor($status) {
    $status_badge = [
      "accepte" => "text-bg-badge-accepte",
      "en_preparation" => "bg-info",
      "en_cours_de_livraison" => "bg-purple",
      "livre" => "bg-teal",
      "restitution_materiel" => "bg-warning",
      "terminee" => "bg-success",
      "annule" => "bg-danger"
    ];

    return $status_badge[$status] ?? 'text-bg-badge-waiting';
  }
?>

<div id="userAccountProfile" class="userAccount">
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
      
      <div>
        <?php
          //Récupérer les commandes
          $query = "
            SELECT
              menu_id
            FROM
              commandes
            WHERE 
              user_id = :id

          ";
          $stmt = $pdo->prepare($query);
          $stmt->bindParam(':id', $_SESSION['user_id']);
          $stmt->execute();

          $commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);

          //Récupérer les menus 
          $query = "
            SELECT
              commandes.id AS commande_id,
              commandes.user_id,
              commandes.status,
              commandes.date_prestation,
              commandes.adresse_livraison,
              commandes.code_postal_livraison,
              commandes.ville_livraison,
              commandes.prix_menu,

              menus.*,

              entrees.titre AS entree_titre,
              entrees.description AS entree_description,

              plats.titre AS plat_titre,
              plats.description AS plat_description,

              desserts.titre AS dessert_titre,
              desserts.description AS dessert_description
              
            FROM
              commandes

            JOIN menus ON commandes.menu_id = menus.id
            JOIN entrees ON menus.entree_id = entrees.id
            JOIN plats ON menus.plat_id = plats.id
            JOIN desserts ON menus.dessert_id = desserts.id

            WHERE
              commandes.user_id = :id

          ";
          $stmt = $pdo->prepare($query);
          $stmt->bindParam(':id', $_SESSION['user_id']);
          $stmt->execute();

          $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="text-left">
          <h1 class="text-primary fw-bold py-4">Mes commandes</h1>
        </div>

        <div class="menu-card-wrapper">
          <!-- CARDS -->
           <?php foreach ($menus as $menu): ?>
          <div class="card card-corner p-0 bg-white">
            <img
              class="forced-in-div shadow"
              src="<?= BASE_URL ?>/<?= $menu['img_path'] ?>"
            />

            <div class="p-4 side-by-side gap-2">
              <div class="menu-info-text">
                <h3 class="m-0"><?= $menu['titre'] ?></h3>
                <p class="text-primary"><?= $menu['description'] ?></p>
                <p class="m-0 fw-bold">
                  <?= $menu['date_prestation'] ?>
                </p>
                <p class="m-0 fw-bold lh-1">
                  <?= $menu['adresse_livraison'] ?>
                </p>
                <p class="m-0 fw-bold lh-1">
                  <?= $menu['code_postal_livraison'] ?> <?= $menu['ville_livraison'] ?>
                </p>
              </div>

              <div class="menu-info-price">
                <p class="mb-0 mt-2"><?= $menu['prix_menu'] ?>€ au total</p>
                  <button
                    type="button"
                    class="btn btn-primary medium-button"
                    data-bs-toggle="modal"
                    data-bs-target="#menuModal"
                  >
                    Détails
                  </button>
              </div>
              
            </div>
            <div class="d-flex justify-content-center mb-3">
                <span class="badge <?= getStatusColor($menu['status']) ?> rounded-pill">
                  <?= !empty($menu['status']) ? $menu['status'] : "En attente"?>
                </span>
              </div>
          </div>

          <!-- Modal -->
          <div
            class="modal fade"
            id="menuModal"
            tabindex="-1"
            aria-labelledby="menuModalTitle"
            aria-hidden="true"
          >
            <div class="row modal-dialog modal-xl modal-dialog-centered">
              <button type="button" class="btn-close text-end m-0" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="modal-content">
                <div class="modal-body p-3 p-sm-5">
                  <h1 class="text-center" id="menuModalTitle"><?= $menu['titre'] ?></h1>

                  <div class="detailed-menu-card-wrapper">
                    <div class="card card-corner p-0 bg-white">
                      <img
                        class="forced-in-div shadow"
                        src="<?= BASE_URL ?>/<?= $menu['img_path'] ?>"
                      />

                      <div class="p-4">
                        <div class="menu-info-text">
                          <p><?= $menu['description'] ?></p>
                          <p class="text-primary fw-bold m-0">
                            Réservation 7 jours avant la date.
                          </p>
                          <p class="text-primary"><?= $menu['nbre_pers_min'] ?> personnes minimum</p>
                          <p class="m-0 fst-italic text-primary test">
                            Il reste <?= $menu['quantite_restante'] ?> commandes possibles de ce menu
                          </p>
                          <p class="mb-0 mt-2 text-center"><?= $menu['prix_par_pers'] ?>€/pers</p>
                        </div>
                      </div>
                    </div>
                    <div class="card card-corner p-0 bg-white">
                      <div class="p-4 py-5">
                        <div class="menu-info-text">

                          <?php
                            $stmt = $pdo->prepare("
                              SELECT allergenes.libelle
                              FROM entree_allergene
                              JOIN allergenes ON allergenes.id = entree_allergene.allergene_id
                              WHERE entree_allergene.entree_id = :id
                            ");

                            $stmt->execute([
                              'id' => $menu['entree_id']
                            ]);

                            $entreeAllergenes = $stmt->fetchAll(PDO::FETCH_COLUMN);
                          
                          ?>

                          <div id="entrée">
                            <h4 class="text-center text-primary fw-bold">Entrée</h4>
                            <h4 class="text-dark fw-bold mb-2"><?= $menu['entree_titre'] ?></h4>
                            <p class="lh-1 mb-0 ms-4">
                              <?= $menu['entree_description'] ?>                                
                            </p>
                            <p class="text-primary mb-0 ms-4 lh-1">
                              <i class="bi bi-info-circle text-primary"></i>
                              Allergènes: <?= implode(', ', $entreeAllergenes) ?>
                            </p>
                          </div>

                          <?php
                            $stmt = $pdo->prepare("
                              SELECT allergenes.libelle
                              FROM plat_allergene
                              JOIN allergenes ON allergenes.id = plat_allergene.allergene_id
                              WHERE plat_allergene.plat_id = :id
                            ");

                            $stmt->execute([
                              'id' => $menu['plat_id']
                            ]);

                            $platAllergenes = $stmt->fetchAll(PDO::FETCH_COLUMN);
                          
                          ?>
                          <div id="Plat-principal" class="mt-4">
                            <h4 class="text-center text-primary fw-bold">Plat principal</h4>
                            <h4 class="text-dark fw-bold mb-2"><?= $menu['plat_titre'] ?></h4>
                            <p class="lh-1 mb-0 ms-4">
                              <?= $menu['plat_description'] ?>
                            </p>
                            <p class="text-primary mb-0 ms-4 lh-1">
                              <i class="bi bi-info-circle text-primary"></i>
                              Allergènes: <?= implode(', ', $platAllergenes) ?>
                            </p>
                          </div>

                          <?php
                            $stmt = $pdo->prepare("
                              SELECT allergenes.libelle
                              FROM dessert_allergene
                              JOIN allergenes ON allergenes.id = dessert_allergene.allergene_id
                              WHERE dessert_allergene.dessert_id = :id
                            ");

                            $stmt->execute([
                              'id' => $menu['dessert_id']
                            ]);

                            $dessertAllergenes = $stmt->fetchAll(PDO::FETCH_COLUMN);
                          
                          ?>

                          <div id="Dessert" class="mt-4">
                            <h4 class="text-center text-primary fw-bold">Dessert</h4>
                            <h4 class="text-dark fw-bold mb-2"><?= $menu['dessert_titre'] ?></h4>
                            <p class="lh-1 mb-0 ms-4">
                              <?= $menu['dessert_description'] ?>
                            </p>
                            <p class="text-primary mb-0 ms-4 lh-1">
                              <i class="bi bi-info-circle text-primary"></i>
                              Allergènes: <?= implode(', ', $dessertAllergenes) ?>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>

        </div>

      </div>
    </div>
  </div>
  
</div>
