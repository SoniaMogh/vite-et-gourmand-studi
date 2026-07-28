<?php
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
  require "databaseLink/staffAccountMenusPost.php";
?>

<div id="staffAccountMenus" class="staffAccount">
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
        

      <div>
        <div class="text-left">
          <h1 class="text-primary fw-bold py-4">Menus</h1>
        </div>

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
                    data-bs-target="#menusModal<?= $menu['id'] ?>"
                  >
                    Détails
                  </button>

                </div>

              </div>
              <div class="d-flex justify-content-center mb-4">
                <button
                    type="button"
                    class="btn btn-info medium-button me-5"
                    data-bs-toggle="modal"
                    data-bs-target="#editMenusModal<?= $menu['id'] ?>"
                  >
                    Modifier
                  </button>
                  <button
                    type="button"
                    class="btn btn-danger medium-button"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteMenusModal<?= $menu['id'] ?>"
                  >
                    Supprimer
                  </button>
              </div>
            </div>

            
            <!-- MODAL DETAIL -->
            <div
              class="modal fade"
              id="menusModal<?= $menu['id'] ?>"
              tabindex="-1"
              aria-labelledby="menuDetailOrderTitle"
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
                    <h1 class="text-center" id="menuDetailOrderTitle"><?= $menu['titre'] ?></h1>

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
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- MODAL EDIT -->
            <div
              class="modal fade"
              id="editMenusModal<?= $menu['id'] ?>"
              tabindex="-1"
              aria-labelledby="letsChange"
              aria-hidden="true"
            >
              <div class="row modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body p-3 p-sm-5">
                    <h2 class="text-center text-warning" id="letsChange">Modifier le menu <?= $menu['titre'] ?> ?</h2>
                    <div class="d-flex justify-content-center gap-4">
                      <form action="<?= BASE_URL ?>/monCompteEmploye/menusPost" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="editMenuId" name="editMenuId" value="<?= $menu['id'] ?>">
                        <div>
                          <div class="col-10">
                            <input type="file" name="imageMenu">
                          </div>
                          <div>
                            <label for="editTitreMenu">Titre</label>
                            <input
                              class="w-100 form-control"
                              type="text"
                              id="editTitreMenu"
                              name="editTitreMenu"
                              value = "<?= htmlspecialchars($menu['titre']) ?>"
                              required
                            />
                          </div>
                          <div>
                            <label for="editDescriptionMenu">Description</label>
                            <textarea
                              class="w-100 form-control"
                              id="editDescriptionMenu"
                              name="editDescriptionMenu"
                              rows="3"
                              required
                            ><?= $menu['description'] ?></textarea>
                          </div>
                          <div class="mb-2 three-wrapper">
                            <div>
                              <label for="editNbrePersMin">Nombre de personne min </label>
                              <input
                                class="w-100 form-control"
                                type="number"
                                id="editNbrePersMin"
                                name="editNbrePersMin"
                                value = <?= $menu['nbre_pers_min'] ?>
                                required
                              />
                            </div>
                            <div>
                              <label for="editPrixPers">Prix par personne</label>
                              <input
                                class="w-100 form-control"
                                type="number"
                                id="editPrixPers"
                                name="editPrixPers"
                                value = <?= $menu['prix_par_pers'] ?>
                                required
                              />
                            </div>
                            <div>
                              <label for="editQuantiteMenu">Quantité</label>
                              <input
                                class="w-100 form-control"
                                type="number"
                                id="editQuantiteMenu"
                                name="editQuantiteMenu"
                                value = <?= $menu['quantite_restante'] ?>
                                required
                              />
                            </div>
                          </div>
                          <div class="mb-2 three-wrapper">

                            <div>
                              <?php

                              $stmtEntree = $pdo->prepare("
                                  SELECT *
                                  FROM entrees
                                  WHERE id = :id
                                ");

                                $stmtEntree->execute([
                                  ':id' => $menu['entree_id']
                                ]);

                                $editEntrees = $stmtEntree->fetch(PDO::FETCH_ASSOC);

                                $stmt = $pdo->prepare("
                                  SELECT *
                                  FROM entrees
                                ");

                                $stmt->execute();

                                $entrees = $stmt->fetchAll(PDO::FETCH_ASSOC);
                              
                              ?>


                              <div class="form-display col">
                                <label for="editEntreeMenu">Entrée</label>
                                <select
                                  name="editEntreeMenu"
                                  id="editEntreeMenu"
                                  class="w-100 form-control"
                                >
                                  <?php foreach ($entrees as $entree): ?>
                                    <option value="<?= $entree['id'] ?>" <?= $entree['id'] == $editEntrees['id'] ? 'selected' : '' ?>>
                                      <?= htmlspecialchars($entree['titre']) ?>
                                  </option>
                                  <?php endforeach; ?>
                                </select>
                                <button
                                  type="button"
                                  class="btn btn-primary large-button"
                                  data-bs-toggle="modal"
                                  data-bs-target="#ajoutEntree"
                                >
                                  Ajouter une entrée
                                </button>
                              </div>
                            </div>

                            <!-- --------------------------- PLAT ------------------------------ -->
                            <div>
                              <?php
                                $stmtPlat = $pdo->prepare("
                                    SELECT *
                                    FROM plats
                                    WHERE id = :id
                                  ");

                                  $stmtPlat->execute([
                                    ':id' => $menu['plat_id']
                                  ]);

                                $editPlat = $stmtPlat->fetch(PDO::FETCH_ASSOC);


                                $stmt = $pdo->prepare("
                                  SELECT *
                                  FROM plats
                                ");

                                $stmt->execute();

                                $plats = $stmt->fetchAll(PDO::FETCH_ASSOC);
                              
                              ?>


                              <div class="form-display col">
                                <label for="editPlatMenu">Plat principal</label>
                                <select
                                  name="editPlatMenu"
                                  id="editPlatMenu"
                                  class="w-100 form-control"
                                >
                                  <?php foreach ($plats as $plat): ?>
                                    <option value="<?= $plat['id'] ?>" <?= $plat['id'] == $editPlat['id'] ? 'selected' : '' ?>>
                                      <?= htmlspecialchars($plat['titre']) ?>
                                    </option>
                                  <?php endforeach; ?>
                                </select>
                                <button
                                  type="button"
                                  class="btn btn-primary large-button"
                                  data-bs-toggle="modal"
                                  data-bs-target="#ajoutPlat"
                                >
                                  Ajouter un plat
                                </button>
                              </div>
                            </div>

                            <!-- --------------------------- DESSERT ------------------------------ -->
                            <div>
                              <?php
                                $stmtDessert = $pdo->prepare("
                                    SELECT *
                                    FROM desserts
                                    WHERE id = :id
                                  ");

                                  $stmtDessert->execute([
                                    ':id' => $menu['dessert_id']
                                  ]);

                                $editDessert = $stmtDessert->fetch(PDO::FETCH_ASSOC);

                                $stmt = $pdo->prepare("
                                  SELECT *
                                  FROM desserts
                                ");

                                $stmt->execute();

                                $desserts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                              
                              ?>


                              <div class="form-display col">
                                <label for="editDessertMenu">Dessert</label>
                                <select
                                  name="editDessertMenu"
                                  id="editDessertMenu"
                                  class="w-100 form-control"
                                >
                                  <?php foreach ($desserts as $dessert): ?>
                                    <option value="<?= $dessert['id'] ?>" <?= $dessert['id'] == $editDessert['id'] ? 'selected' : '' ?>>
                                      <?= htmlspecialchars($dessert['titre']) ?>
                                    </option>
                                  <?php endforeach; ?>
                                </select>
                                <button
                                  type="button"
                                  class="btn btn-primary large-button"
                                  data-bs-toggle="modal"
                                  data-bs-target="#ajoutDessert"
                                >
                                  Ajouter un dessert
                                </button>
                              </div>
                            </div>
                          </div>

                          <!-- --------------------------- REGIME ------------------------------ -->
                          <div>

                            <?php

                                $stmtRegime = $pdo->prepare("
                                  SELECT *
                                  FROM regimes
                                  WHERE id = :id
                                ");

                                $stmtRegime->execute([
                                  ':id' => $menu['regime_id']
                                ]);

                              $editRegime = $stmtRegime->fetch(PDO::FETCH_ASSOC);
                              $stmt = $pdo->prepare("
                                SELECT *
                                FROM regimes
                              ");

                              $stmt->execute();

                              $regimes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            ?>


                            <div class="form-display col">
                              <label for="editRegimeMenu">Régimes</label>
                              <select
                                name="editRegimeMenu"
                                id="editRegimeMenu"
                                class="w-100 form-control"
                              >
                                <?php foreach ($regimes as $regime): ?>
                                  <option value="<?= $regime['id'] ?>" <?= $regime['id'] == $editRegime['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($regime['libelle']) ?>
                                  </option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>

                          <!-- --------------------------- THEME ------------------------------ -->
                          <div>
                            <?php
                              $stmtTheme = $pdo->prepare("
                                SELECT *
                                FROM themes
                                WHERE id = :id
                              ");

                              $stmtTheme->execute([
                                ':id' => $menu['theme_id']
                              ]);

                              $editTheme = $stmtTheme->fetch(PDO::FETCH_ASSOC);
                              $stmt = $pdo->prepare("
                                SELECT *
                                FROM themes
                              ");

                              $stmt->execute();

                              $themes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            ?>


                            <div class="form-display col">
                              <label for="editThemeMenu">Themes</label>
                              <select
                                name="editThemeMenu"
                                id="editThemeMenu"
                                class="w-100 form-control"
                              >
                                <?php foreach ($themes as $theme): ?>
                                  <option value="<?= $theme['id'] ?>" <?= $theme['id'] == $editTheme['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($theme['libelle']) ?>
                                  </option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                        </div>
                          
                          
                        <div class="d-flex justify-content-center gap-4">
                          <button 
                            class="btn btn-danger medium-button mt-4" 
                            type="submit"
                            name="editMenubtn"
                          >
                            Valider 
                          </button>
                          <button
                            type="button"
                            class="btn btn-primary medium-button mt-4"
                            data-bs-dismiss="modal"
                          > 
                            Annuler
                          </button>
                        </div>
                      </form>


                    </div>

                  </div>
                </div>
              </div>
            </div>

            <!-- MODAL SUPPRESSION -->
            <div
              class="modal fade"
              id="deleteMenusModal<?= $menu['id'] ?>"
              tabindex="-1"
              aria-labelledby="areYouSureAboutThat"
              aria-hidden="true"
            >
              <div class="row modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body p-3 p-sm-5">
                    <h2 class="text-center text-warning" id="areYouSureAboutThat">Etes vous certain de vouloir supprimer le menu <?= $menu['titre'] ?> ?</h2>
                    <div class="d-flex justify-content-center gap-4">
                      <form action="<?= BASE_URL ?>/monCompteEmploye/menusPost" method="post">
                        <input type="hidden" id="deleteMenuId" name="deleteMenuId" value="<?= $menu['id'] ?>">
                        
                        <button 
                          class="btn btn-danger medium-button mt-4" 
                          type="submit"
                          name="deleteMenubtn"
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

          <!-- CARD ADD  -->
            <a href="<?= BASE_URL ?>/monCompteEmploye/staffAccountAddMenu">
            <div class="card card-corner p-0 bg-white card-add">
              <i class="bi bi-plus-circle size_button_add_menu"></i>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
