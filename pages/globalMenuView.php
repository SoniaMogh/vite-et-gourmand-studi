<?php
    //Récupérer les menus 
  $query = "
    SELECT
      menus.*,

        entrees.titre AS entree_titre,
        entrees.description AS entree_description,

        plats.titre AS plat_titre,
        plats.description AS plat_description,

        desserts.titre AS dessert_titre,
        desserts.description AS dessert_description
      
    FROM
      menus
    JOIN entrees ON menus.entree_id = entrees.id
    JOIN plats ON menus.plat_id = plats.id
    JOIN desserts ON menus.dessert_id = desserts.id
  ";
  $stmt = $pdo->prepare($query);
  $stmt->execute();

  $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="globalMenuView">
  <div class="bigtitle bigtitle-global-view text-center text-white">
    <div class="bigtitle-content">
      <h1 class="bigtitle-title">Carte des menus</h1>
    </div>
  </div>

  <div id="global-view-filter">
    <div class="container py-5 px-5">
      <div class="row bg-white card-corner p-4">
        <div class="form-display col">
          <label for="theme">Theme</label>
          <select
            name="theme"
            id="theme"
            placeholder="tout"
            class="w-100 form-control"
          >
            <option value="Classique">Classique</option>
            <option value="Evénement">Evénement</option>
            <option value="Noël">Noël</option>
            <option value="Halloween">Halloween</option>
            <option value="Gastronomique">Gastronomique</option>
            <option value="Saison">Saison</option>
          </select>
        </div>
        <div class="form-display col">
          <label for="regime">Régime</label>
          <select
            name="regime"
            id="regime"
            placeholder="tout"
            class="w-100 form-control"
          >
            <option value="Classique">Classique</option>
            <option value="Vegetarien">Végétarien</option>
            <option value="Vegan">Végan</option>
            <option value="Sans-fruit-de-mer">Sans fruit de mer</option>
          </select>
        </div>
        <div class="form-display col">
          <label for="min-price">Prix minimum</label>
          <input
            name="min-price"
            id="min-price"
            placeholder="Ex: 25"
            class="w-100 form-control"
          >
          </input>
        </div>
        <div class="form-display col">
          <label for="max-price">Prix maximum</label>
          <input
            name="max-price"
            id="max-price"
            placeholder="Ex: 100"
            class="w-100 form-control"
          >
          </input>
        </div>
        <div class="form-display col">
          <label for="nbr-pers">Nombre de personne</label>
          <input
            name="nbr-pers"
            id="nbr-pers"
            placeholder="Ex: 2"
            class="w-100 form-control"
          >
          </input>
        </div>
      </div>
    </div>
  </div>

  <div id="menus">
    <div class="container pb-5 px-5">
      <div class="menu-card-wrapper">
        <?php foreach ($menus as $menu): ?>
          <!-- CARD  -->
          <div class="card card-corner p-0 bg-white">
            <img
              class="forced-in-div shadow"
              src="<?= BASE_URL ?>/<?= $menu['img_path'] ?>"
            />

            <div class="p-4 side-by-side-info-card-staff gap-2">
              <div class="menu-info-text">
                <h3 class="m-0"><?= $menu['titre'] ?></h3>
                <p class="text-primary">
                  <?= $menu['nbre_pers_min'] ?> personnes minimum
                </p>
                <p class="m-0"><?= $menu['description'] ?></p>
              </div>

              <div class="menu-info-price-staff">

                <p class="mb-0 mt-2">
                  <?= $menu['prix_par_pers'] ?>
                  €/pers
                </p>
                <button
                  type="button"
                  class="btn btn-primary medium-button"
                  data-bs-toggle="modal"
                  data-bs-target="#orderMenusModal<?= $menu['id'] ?>"
                >
                  Détails
                </button>

              </div>
            </div>
          </div>

          
          <!-- MODAL DETAIL -->
          <div
            class="modal fade"
            id="orderMenusModal<?= $menu['id'] ?>"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
          >
            <div class="row modal-dialog modal-xl modal-dialog-centered">
              <button
                type="button"
                class="btn-close text-end m-0"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
              <div class="modal-content">
                <div class="modal-body p-3 p-sm-5">
                  <h1 class="text-center"><?= $menu['titre'] ?></h1>

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
                          <p class="mb-0 mt-2 text-center"><?= $menu['prix_par_pers'] ?> €/pers</p>
                        </div>
                      </div>
                    </div>

                    <div>
                      <div class="card card-corner p-0 bg-white mb-4">
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
                              <h4 class="text-center text-primary fw-bold">
                                Entrée
                              </h4>
                              <h4 class="text-dark fw-bold mb-2">
                                <?= $menu['entree_titre']?>
                              </h4>
                              <p class="lh-1 mb-0 ms-4">
                                <?= $menu['entree_description']?>
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
                              <h4 class="text-center text-primary fw-bold">
                                Plat
                              </h4>
                              <h4 class="text-dark fw-bold mb-2">
                                <?= $menu['plat_titre']?>
                              </h4>
                              <p class="lh-1 mb-0 ms-4">
                                <?= $menu['plat_description']?>
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
                              <h4 class="text-center text-primary fw-bold">
                                Dessert
                              </h4>
                              <h4 class="text-dark fw-bold mb-2">
                                <?= $menu['dessert_titre']?>
                              </h4>
                              <p class="lh-1 mb-0 ms-4">
                                <?= $menu['dessert_description']?>
                              </p>
                              <p class="text-primary mb-0 ms-4 lh-1">
                                <i class="bi bi-info-circle text-primary"></i>
                                Allergènes: <?= implode(', ', $dessertAllergenes) ?>
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row justify-content-center">
                        <a 
                          href="<?= BASE_URL ?>/commander?id=<?= $menu['id'] ?>" 
                          class="btn btn-primary large-button"
                        >
                          Commander
                        </a>

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
