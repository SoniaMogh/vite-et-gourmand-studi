<div id="contact-part">
  <div class="container py-5">
    <div class="row card py-5 mx-5 mx-md-6 card-corner">
      <div class="col-12 text-center">
        <h1 class="text-primary">Ajouter un menu</h1>
      </div>
      <form action="<?= BASE_URL ?>/monCompteEmploye/staffAccountAddMenuPost" method="post" class="form-display" enctype="multipart/form-data">
        <div class="col-10">
          <label for="reason-contact">Ajouter une image</label>
          <input type="file" name="imageMenu" required>
        </div>
        <div class="col-10">
          <label for="titreMenu">Titre</label>
          <input
            class="w-100 form-control"
            type="text"
            id="titreMenu"
            name="titreMenu"
            required
          />
        </div>
        <div class="col-10">
          <label for="descriptionMenu">Description</label>
          <textarea
            class="w-100 form-control"
            id="descriptionMenu"
            name="descriptionMenu"
            rows="3"
            placeholder="Décrivez votre menu..."
            required
          ></textarea>
        </div>
        <div class="mb-2 col-10 three-wrapper">
          <div>
            <label for="nbrePersMin">Nombre de personne min </label>
            <input
              class="w-100 form-control"
              type="number"
              id="nbrePersMin"
              name="nbrePersMin"
              required
            />
          </div>
          <div>
            <label for="prixPers">Prix par personne</label>
            <input
              class="w-100 form-control"
              type="number"
              id="prixPers"
              name="prixPers"
              required
            />
          </div>
          <div>
            <label for="quantiteMenu">Quantité</label>
            <input
              class="w-100 form-control"
              type="number"
              id="quantiteMenu"
              name="quantiteMenu"
              required
            />
          </div>
        </div>
        <div class="mb-2 col-10 three-wrapper">

          <div>
            <?php
              $stmt = $pdo->prepare("
                SELECT *
                FROM entrees
              ");

              $stmt->execute();

              $entrees = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            ?>


            <div class="form-display col">
              <label for="entreeMenu">Entrée</label>
              <select
                name="entreeMenu"
                id="entreeMenu"
                class="w-100 form-control"
              >
                <?php foreach ($entrees as $entree): ?>
                  <option value="<?= $entree['id']?>"><?= $entree['titre'] ?></option>
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
              $stmt = $pdo->prepare("
                SELECT *
                FROM plats
              ");

              $stmt->execute();

              $plats = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            ?>


            <div class="form-display col">
              <label for="platMenu">Plat principal</label>
              <select
                name="platMenu"
                id="platMenu"
                class="w-100 form-control"
              >
                <?php foreach ($plats as $plat): ?>
                  <option value="<?= $plat['id']?>"><?= $plat['titre'] ?></option>
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
              $stmt = $pdo->prepare("
                SELECT *
                FROM desserts
              ");

              $stmt->execute();

              $desserts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            ?>


            <div class="form-display col">
              <label for="dessertMenu">Dessert</label>
              <select
                name="dessertMenu"
                id="dessertMenu"
                class="w-100 form-control"
              >
                <?php foreach ($desserts as $dessert): ?>
                  <option value="<?= $dessert['id']?>"><?= $dessert['titre'] ?></option>
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
        <div class="mb-2 col-10 signup-wrapper">

        <!-- --------------------------- REGIME ------------------------------ -->
          <div>

            <?php
              $stmt = $pdo->prepare("
                SELECT *
                FROM regimes
              ");

              $stmt->execute();

              $regimes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            ?>


            <div class="form-display col">
              <label for="regimeMenu">Régimes</label>
              <select
                name="regimeMenu"
                id="regimeMenu"
                class="w-100 form-control"
              >
                <?php foreach ($regimes as $regime): ?>
                  <option value="<?= $regime['id']?>"><?= $regime['libelle'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <!-- --------------------------- THEME ------------------------------ -->
          <div>
            <?php
              $stmt = $pdo->prepare("
                SELECT *
                FROM themes
              ");

              $stmt->execute();

              $themes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            ?>


            <div class="form-display col">
              <label for="themeMenu">Themes</label>
              <select
                name="themeMenu"
                id="themeMenu"
                class="w-100 form-control"
              >
                <?php foreach ($themes as $theme): ?>
                  <option value="<?= $theme['id']?>"><?= $theme['libelle'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>


        <input type="submit" value="Créer" class="btn btn-primary medium-button" name="addMenubtn">
      </form>
    </div>



    <!-- --------------------------- MODAL ENTREE  ------------------------------ -->
    <div
      class="modal fade"
      id="ajoutEntree"
      tabindex="-1"
      aria-labelledby="titreModalAjoutEntree"
      aria-hidden="true"
    >
      <div class="row modal-dialog modal-xl">
        <button type="button" class="btn-close text-end m-0" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-content">
          <div class="modal-body p-3 p-sm-5">
            <h1 class="text-center" id="titreModalAjoutEntree">Ajouter une entrée</h1>
            <form action="<?= BASE_URL ?>/monCompteEmploye/staffAccountAddMenuPost" method="post" class="form-display">
              <div class="col-10">
                <label for="addTitreEntree">Nom de votre entrée</label>
                <input
                  class="w-100 form-control"
                  type="text"
                  id="addTitreEntree"
                  name="addTitreEntree"
                  required
                />
              </div>
              <div class="col-10">
                <label for="addDescriptionEntree">Description</label>
                <textarea
                  class="w-100 form-control"
                  id="addDescriptionEntree"
                  name="addDescriptionEntree"
                  rows="3"
                  placeholder="Décrivez votre entrée..."
                  required
                ></textarea>
              </div>

              <div>
            <?php
              $stmt = $pdo->prepare("
                SELECT *
                FROM allergenes
              ");

              $stmt->execute();

              $allergenes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            ?>


            <div class="d-flex flex-column flex-start">
              <h4>Allergènes</h4>

                <?php foreach ($allergenes as $allergene): ?>
                  <div class="d-flex flex-start">
                    <input class="mb-0 me-2" type="checkbox" id="allergene_<?= $allergene['id']?>" name="allergenes[]" value="<?= $allergene['id']?>"/>
                    <label for="allergene_<?= $allergene['id']?>"><?= $allergene['libelle']?></label>
                  </div>
                <?php endforeach; ?>
              <button 
                class="btn btn-primary medium-button mt-4" 
                type="submit"
                name="addEntreebtn"
              >
                Ajouter
              </button>
            </div>
          </div>

            </form>
            
          </div>
        </div>
      </div>
    </div>

    <!-- --------------------------- MODAL PLAT  ------------------------------ -->
    <div
      class="modal fade"
      id="ajoutPlat"
      tabindex="-1"
      aria-labelledby="titreModalAjoutPlat"
      aria-hidden="true"
    >
      <div class="row modal-dialog modal-xl">
        <button type="button" class="btn-close text-end m-0" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-content">
          <div class="modal-body p-3 p-sm-5">
            <h1 class="text-center" id="titreModalAjoutPlat">Ajouter un plat</h1>
            <form action="<?= BASE_URL ?>/monCompteEmploye/staffAccountAddMenuPost" method="post" class="form-display">
              <div class="col-10">
                <label for="addTitrePlat">Nom de votre plat</label>
                <input
                  class="w-100 form-control"
                  type="text"
                  id="addTitrePlat"
                  name="addTitrePlat"
                  required
                />
              </div>
              <div class="col-10">
                <label for="addDescriptionPlat">Description</label>
                <textarea
                  class="w-100 form-control"
                  id="addDescriptionPlat"
                  name="addDescriptionPlat"
                  rows="3"
                  placeholder="Décrivez votre plat..."
                  required
                ></textarea>
              </div>

              <div>
            <?php
              $stmt = $pdo->prepare("
                SELECT *
                FROM allergenes
              ");

              $stmt->execute();

              $allergenes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            ?>


            <div class="d-flex flex-column flex-start">
              <h4>Allergènes</h4>

                <?php foreach ($allergenes as $allergene): ?>
                  <div class="d-flex flex-start">
                    <input class="mb-0 me-2" type="checkbox" id="allergene_<?= $allergene['id']?>" name="allergenes[]" value="<?= $allergene['id']?>"/>
                    <label for="allergene_<?= $allergene['id']?>"><?= $allergene['libelle']?></label>
                  </div>
                <?php endforeach; ?>
              <button 
                class="btn btn-primary medium-button mt-4" 
                type="submit"
                name="addPlatbtn"
              >
                Ajouter
              </button>
            </div>
          </div>

            </form>
            
          </div>
        </div>
      </div>
    </div>

    <!-- --------------------------- MODAL DESSERT  ------------------------------ -->
    <div
      class="modal fade"
      id="ajoutDessert"
      tabindex="-1"
      aria-labelledby="titreModalAjoutDessert"
      aria-hidden="true"
    >
      <div class="row modal-dialog modal-xl">
        <button type="button" class="btn-close text-end m-0" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-content">
          <div class="modal-body p-3 p-sm-5">
            <h1 class="text-center" id="titreModalAjoutDessert">Ajouter un dessert</h1>
            <form action="<?= BASE_URL ?>/monCompteEmploye/staffAccountAddMenuPost" method="post" class="form-display">
              <div class="col-10">
                <label for="addTitreDessert">Nom de votre dessert</label>
                <input
                  class="w-100 form-control"
                  type="text"
                  id="addTitreDessert"
                  name="addTitreDessert"
                  required
                />
              </div>
              <div class="col-10">
                <label for="addDescriptionDessert">Description</label>
                <textarea
                  class="w-100 form-control"
                  id="addDescriptionDessert"
                  name="addDescriptionDessert"
                  rows="3"
                  placeholder="Décrivez votre dessert..."
                  required
                ></textarea>
              </div>

              <div>
            <?php
              $stmt = $pdo->prepare("
                SELECT *
                FROM allergenes
              ");

              $stmt->execute();

              $allergenes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            ?>


            <div class="d-flex flex-column flex-start">
              <h4>Allergènes</h4>

                <?php foreach ($allergenes as $allergene): ?>
                  <div class="d-flex flex-start">
                    <input class="mb-0 me-2" type="checkbox" id="allergene_<?= $allergene['id']?>" name="allergenes[]" value="<?= $allergene['id']?>"/>
                    <label for="allergene_<?= $allergene['id']?>"><?= $allergene['libelle']?></label>
                  </div>
                <?php endforeach; ?>
              <button 
                class="btn btn-primary medium-button mt-4" 
                type="submit"
                name="addDessertbtn"
              >
                Ajouter
              </button>
            </div>
          </div>

            </form>
            
          </div>
        </div>
      </div>
    </div>
  </div>


</div>
