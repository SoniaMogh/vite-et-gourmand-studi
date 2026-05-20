<?php
  session_start();
  $login = BASE_URL . "/connexion";
  $compteEmploye = BASE_URL . "/monCompteEmploye/InfosRestaurant";
  $carteMenus = BASE_URL . "/carteDesMenus";
  $menuId = $_GET['id'] ?? null;
  // Si la session n'existe pas, on bloque l'accès à l'utilisateur
  if (!isset($_SESSION['user_id'])) {
    header("Location: $login");
    exit;
  // Si la session existe et que l'utilisateur est un employe
  } elseif (isset($_SESSION['user_role'])) {
      header("Location: $compteEmploye");
      exit;
    
  } elseif (!isset($menuId)) {
      header("Location: $carteMenus");
      exit;
  };

  
  //Récupérer le menu
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
    WHERE
      menus.id = :id
  ";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':id', $menuId);
  $stmt->execute();

  $menuChoisis = $stmt->fetch(PDO::FETCH_ASSOC);

  //Récupérer l'utilisateur 
  $query = "
    SELECT
      *
    FROM
      users
    WHERE
      id = :id
  ";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':id', $_SESSION['user_id']);
  $stmt->execute();

  $user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div id="order-part">
  <div class="container py-5 ">
    <form
      action="<?= BASE_URL ?>/commanderPost"
      method="post"
      class="form-display"
    >
    <input type="hidden" name="orderMenuId" value=<?=$menuId?>>
    <input type="hidden" name="orderUserId" value=<?=$_SESSION['user_id']?>>
      <div class="col-12 text-center">
        <h1 class="text-white m-0">Vous souhaitez commander ?</h1>
        <h1 class="text-white pb-2">C'est par ici !</h1>
      </div>
      <div class="row py-5 p-xl-5">
        <div class="col-12">   
          <div id="deliveryDetail">
            <h2 class="text-center text-light mb-5">Détail de livraison</h2>
            <div class="mb-2 signup-wrapper">
              <div>
                <label for="orderName">Nom</label>
                <input
                  class="form-control m-0"
                  type="text"
                  id="orderName"
                  name="orderName"
                  value= <?= $user['nom'] ?>
                  required
                />
              </div>
              <div>
                <label for="orderSurname">Prénom</label>
                <input
                  class="form-control m-0"
                  type="text"
                  id="orderSurname"
                  name="orderSurname"
                  value= <?= $user['prenom'] ?>
                  required
                />
              </div>
            </div>
            <div class="mb-2">
              <label for="orderTel">Numéro de téléphone</label>
              <input
                class="form-control m-0"
                type="tel"
                id="orderTel"
                name="orderTel"
                value= <?= $user['telephone'] ?>
                pattern="0[0-9]{9}"
                required
              />
            </div>
            <div class="mb-2">
              <label for="orderEmail">Email</label>
              <input
                class="form-control m-0"
                type="email"
                id="orderEmail"
                name="orderEmail"
                value= <?= $user['email'] ?>
                required
              />
            </div>
            <div class="mb-2 signup-wrapper">
              <div>
                <label for="orderDeliveryHour">Heure de livraison</label>
                <input
                  class="form-control m-0"
                  type="time"
                  id="orderDeliveryHour"
                  name="orderDeliveryHour"
                  required
                />
              </div>
              <div>
                <label for="orderDeliveryDate">Date de livraison</label>
                <input
                  class="form-control m-0"
                  type="date"
                  id="orderDeliveryDate"
                  name="orderDeliveryDate"
                  required
                />
              </div>
            </div>
            <div class="mb-2">
              <label for="orderDeliveryAddress">Adresse de livraison</label>
              <input
                class="form-control m-0"
                type="text"
                id="orderDeliveryAddress"
                name="orderDeliveryAddress"
                required
              />
            </div>
            <div class="mb-2 signup-wrapper">
              <div>
                <label for="orderDeliveryZIP">Code postal</label>
                <input
                  class="form-control m-0"
                  type="text"
                  inputmode="numeric"
                  pattern="[0-9]{5}"
                  id="orderDeliveryZIP"
                  name="orderDeliveryZIP"
                  required
                />
              </div>
              <div>
                <label for="orderDeliveryCity">Ville</label>
                <input
                  class="form-control m-0"
                  type="text"
                  id="orderDeliveryCity"
                  name="orderDeliveryCity"
                  required
                />
              </div>
            </div>
            <div class="d-flex">
              <input class="mb-0 me-2 d-flex" type="checkbox" id="lendStuff?>" name="lendStuff" value="Oui"/>
              <label for="lendStuff">
                <h4 class="m-0 lh-1 text-secondary">Prêt de matériel</h4>
                <p class="lh-1 text-light m-0">Quelqu'un vous contactera dans les prochains jours</p>
              </label>
            </div>

            <hr class="text-light bg-light col-12" />

    
            <h2 class="text-center text-light mb-5">Le menu choisis</h2>
            <div class="mb-2">
              <label for="orderNbrPers">Nombre de personne (<?= $menuChoisis['nbre_pers_min'] ?> personnes minimum)</label>
              <input
                class="form-control m-0"
                type="number"
                min="<?= $menuChoisis['nbre_pers_min'] ?>"
                id="orderNbrPers"
                name="orderNbrPers"
                required
              />
              <p class="text-center text-white">Une réduction de 10% sera appliquée pour toutes commandes de plus de 7 personnes.</p>
            </div>
            <div class="card card-corner p-0 bg-white">
              <img
                class="forced-in-div shadow"
                src="<?= BASE_URL ?>/<?= $menuChoisis['img_path'] ?>"
              />

              <div class="p-4 side-by-side-info-card-staff gap-2">
                <div class="menu-info-text">
                  <h3 class="m-0 text-center"><?= $menuChoisis['titre'] ?></h3>
                  <p class="text-primary text-center">
                    <?= $menuChoisis['nbre_pers_min'] ?> personnes minimum
                  </p>
                  <p class="m-0 text-center"><?= $menuChoisis['description'] ?></p>
                  <div class="d-flex justify-content-center mt-2">
                    <button
                      type="button"
                      class="btn btn-primary medium-button me-4"
                      data-bs-toggle="modal"
                      data-bs-target="#orderChoosenMenusModal"
                    >
                      Détails
                    </button>
                    <a 
                      href="<?= BASE_URL ?>/carteDesMenus" 
                      class="mb-0 btn btn-warning large-button"
                    >
                      Changer de menu
                    </a>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <hr class="text-light bg-light col-12 mb-0" />
        </div>
      </div>
      <div class="row px-xl-5">
        <div class="card card-corner p-4">
          <div class="col-12 text-center">
            <h2 class="text-dark mb-3">Détails</h2>
          </div>
          <div class="d-flex justify-content-between">
            <div class="d-flex flex-column justify-content-start ms-5">
              <p class="text-dark m-0">Prix menu:</p>
              <p class="text-dark m-0">Total avant réduction:</p>
              <p class="text-primary fw-bold m-0">Reduction -10%:</p>
              <h3 class="text-dark fw-bold m-0">Montant total:</h3>
              <p class="text-primary m-0">Le total de la commande inclut la TVA.</p>

              
            </div>
            <script>
              document.addEventListener('DOMContentLoaded', () => {

                const inputNbrPers = document.getElementById('orderNbrPers');
                const totalPriceBeforeReduction = document.getElementById('totalPriceBeforeReduction');
                const reducedPrice = document.getElementById('reducedPrice');
                const totalPrice = document.getElementById('totalPrice');
                const totalPriceInput = document.getElementById('totalPriceInput');

                const prixParPers = <?= $menuChoisis['prix_par_pers'] ?>;

                inputNbrPers.addEventListener('input', () => {
                  const nbrPers = parseInt(inputNbrPers.value) || 0;

                  let total = prixParPers * nbrPers;
                  let totalReduced = total;

                  totalPriceBeforeReduction.textContent = total + ' €';


                  if (nbrPers >= 7) {
                    totalReduced = total * 0.9;
                    reducedPrice.textContent = totalReduced.toFixed(2) + ' €';
                  } else {
                    reducedPrice.textContent = '0 €';
                  }

                  totalPrice.textContent = totalReduced.toFixed(2) + ' €';
                  totalPriceInput.value = totalReduced.toFixed(2);
                  
                });

              });
            </script>
            <div class="d-flex flex-column text-end me-5">
              <p class="text-dark m-0" id="menuPrice"><?= $menuChoisis['prix_par_pers']?> €</p>
              <p class="text-dark m-0" id="totalPriceBeforeReduction">0 €</p>
              <p class="text-primary fw-bold m-0" id="reducedPrice">0 €</p>
              <h3 class="text-dark fw-bold m-0" id="totalPrice">0 €</h3>
              <input type="hidden" name="totalPrice" id="totalPriceInput">
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
        <button type="submit" class="btn btn-primary large-button">
          Commander
        </button>
      </div>
      </div>
      
    </form>
  </div>

  <!-- MODAL DETAIL -->
  <div
    class="modal fade"
    id="orderChoosenMenusModal"
    tabindex="-1"
    aria-labelledby="orderChoosenMenusTitle"
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
          <h1 class="text-center" id="orderChoosenMenusTitle"><?= $menuChoisis['titre'] ?></h1>

          <div class="detailed-menu-card-wrapper">
            <div class="card card-corner p-0 bg-white">
              <img
                class="forced-in-div shadow"
                src="<?= BASE_URL ?>/<?= $menuChoisis['img_path'] ?>"
              />

              <div class="p-4">
                <div class="menu-info-text">
                  <p><?= $menuChoisis['description'] ?></p>
                  <p class="text-primary fw-bold m-0">
                    Réservation 7 jours avant la date.
                  </p>
                  <p class="text-primary"><?= $menuChoisis['nbre_pers_min'] ?> personnes minimum</p>
                  <p class="m-0 fst-italic text-primary test">
                    Il reste <?= $menuChoisis['quantite_restante'] ?> commandes possibles de ce menu
                  </p>
                  <p class="mb-0 mt-2 text-center"><?= $menuChoisis['prix_par_pers'] ?> €/pers</p>
                </div>
              </div>
            </div>

            <div>
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
                        'id' => $menuChoisis['entree_id']
                      ]);

                      $entreeAllergenes = $stmt->fetchAll(PDO::FETCH_COLUMN);
                    
                    ?>

                    <div id="entrée">
                      <h4 class="text-center text-primary fw-bold">
                        Entrée
                      </h4>
                      <h4 class="text-dark fw-bold mb-2">
                        <?= $menuChoisis['entree_titre']?>
                      </h4>
                      <p class="lh-1 mb-0 ms-4">
                        <?= $menuChoisis['entree_description']?>
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
                        'id' => $menuChoisis['plat_id']
                      ]);

                      $platAllergenes = $stmt->fetchAll(PDO::FETCH_COLUMN);
                    
                    ?>
                    
                    <div id="Plat-principal" class="mt-4">
                      <h4 class="text-center text-primary fw-bold">
                        Plat
                      </h4>
                      <h4 class="text-dark fw-bold mb-2">
                        <?= $menuChoisis['plat_titre']?>
                      </h4>
                      <p class="lh-1 mb-0 ms-4">
                        <?= $menuChoisis['plat_description']?>
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
                        'id' => $menuChoisis['dessert_id']
                      ]);

                      $dessertAllergenes = $stmt->fetchAll(PDO::FETCH_COLUMN);
                    
                    ?>

                    <div id="Dessert" class="mt-4">
                      <h4 class="text-center text-primary fw-bold">
                        Dessert
                      </h4>
                      <h4 class="text-dark fw-bold mb-2">
                        <?= $menuChoisis['dessert_titre']?>
                      </h4>
                      <p class="lh-1 mb-0 ms-4">
                        <?= $menuChoisis['dessert_description']?>
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
</div>
