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
        <!-- ---------------------------CARD 1--------------------------------- -->
        <div class="card card-corner p-0 bg-white">
          <img
            class="forced-in-div shadow"
            src="<?= BASE_URL ?>/assets/pictures/fresh-product-key-point.jpg"
          />

          <div class="p-4 side-by-side">
            <div class="menu-info-text">
              <h2 class="m-0">Esprit de fête</h2>
              <p class="text-primary">2 personnes minimum</p>
              <p class="m-0">
                Partagez un plat chaud entouré de vos être chers pour Noël
              </p>
            </div>

            <div class="menu-info-price">
              <p class="mb-0 mt-2">45 €/pers</p>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#menuModal"
              >
                Détails
              </button>
            </div>
          </div>
        </div>

        <!-- ---------------------------CARD 2--------------------------------- -->
        <div class="card card-corner p-0 bg-white">
          <img
            class="forced-in-div shadow"
            src="<?= BASE_URL ?>/assets/pictures/fresh-product-key-point.jpg"
          />

          <div class="p-4 side-by-side">
            <div class="menu-info-text">
              <h2 class="m-0">Esprit de fête</h2>
              <p class="text-primary">2 personnes minimum</p>
              <p class="m-0">
                Partagez un plat chaud entouré de vos être chers pour Noël
              </p>
            </div>

            <div class="menu-info-price">
              <p class="mb-0 mt-2">45 €/pers</p>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#menuModal"
              >
                Détails
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div
    class="modal fade"
    id="menuModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="row modal-dialog modal-xl modal-dialog-centered">
      <button type="button" class="btn-close text-end m-0" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-content">
        <div class="modal-body p-3 p-sm-5">
          <h1 class="text-center">Convivial & Gourmand</h1>

          <div class="detailed-menu-card-wrapper">
            <div class="card card-corner p-0 bg-white">
              <img
                class="forced-in-div shadow"
                src="<?= BASE_URL ?>/assets/pictures/fresh-product-key-point.jpg"
              />

              <div class="p-4">
                <div class="menu-info-text">
                  <p>Partagez un repas en famille ou entre amis.</p>
                  <p class="text-primary fw-bold m-0">
                    Réservation 8 jours avant la date.
                  </p>
                  <p class="text-primary">2 personnes minimum</p>
                  <p class="m-0 fst-italic text-primary test">
                    Il reste 9 commandes possibles de ce menu
                  </p>
                  <p class="mb-0 mt-2 text-center">45 €/pers</p>
                </div>
              </div>
            </div>
            <div>
              <div class="card card-corner p-0 bg-white mb-4">
                <div class="p-4 py-5">
                  <div class="menu-info-text">
                    <div id="entrée">
                      <h4 class="text-center text-primary fw-bold">Entrée</h4>
                      <h4 class="text-dark fw-bold mb-2">Bourrata Gourmande</h4>
                      <p class="lh-1 mb-0 ms-4">
                        Burrata crémeuse, tomates anciennes, pesto basilic,
                        roquette, pignons torréfiés
                      </p>
                      <p class="text-primary mb-0 ms-4 lh-1">
                        <i class="bi bi-info-circle text-primary"></i>
                        Allergènes: Lait, fruits à coque (pignons)
                      </p>
                    </div>
                    <div id="Plat-principal" class="mt-4">
                      <h4 class="text-center text-primary fw-bold">Entrée</h4>
                      <h4 class="text-dark fw-bold mb-2">Bourrata Gourmande</h4>
                      <p class="lh-1 mb-0 ms-4">
                        Burrata crémeuse, tomates anciennes, pesto basilic,
                        roquette, pignons torréfiés
                      </p>
                      <p class="text-primary mb-0 ms-4 lh-1">
                        <i class="bi bi-info-circle text-primary"></i>
                        Allergènes: Lait, fruits à coque (pignons)
                      </p>
                    </div>
                    <div id="Dessert" class="mt-4">
                      <h4 class="text-center text-primary fw-bold">Entrée</h4>
                      <h4 class="text-dark fw-bold mb-2">Bourrata Gourmande</h4>
                      <p class="lh-1 mb-0 ms-4">
                        Burrata crémeuse, tomates anciennes, pesto basilic,
                        roquette, pignons torréfiés
                      </p>
                      <p class="text-primary mb-0 ms-4 lh-1">
                        <i class="bi bi-info-circle text-primary"></i>
                        Allergènes: Lait, fruits à coque (pignons)
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row justify-content-center">
              <button
                type="button"
                class="btn btn-primary "
              >
                Commander
              </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
