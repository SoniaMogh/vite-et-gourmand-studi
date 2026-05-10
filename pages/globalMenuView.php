<div id="globalMenuView">
  <div class="bigtitle bigtitle-global-view text-center text-white">
    <div class="bigtitle-content">
      <h1 class="bigtitle-title">Carte des menus</h1>
    </div>
  </div>

  <div id="global-view-filter">
    <div class="container py-5 px-5">
      <div class="bg-white card-corner p-4">
        <div class="col-2 form-display">
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
      </div>
    </div>
  </div>

  <div id="menus">
    <div class="container pb-5 px-5">
      <div class="menu-card-wrapper">

        <!-- ---------------------------CARD 1--------------------------------- -->
        <div class="card card-corner global-view-card p-0 bg-white">
          <div class="img-menu-card">
            <img
              class="forced-in-div shadow"
              src="<?= BASE_URL ?>/assets/pictures/fresh-product-key-point.jpg"
            />
          </div>

          <div class="p-4 display-info-menu">
            <div class="menu-info-text">
              <h2 class="m-0">Esprit de fête</h2>
              <p class="text-primary">2 personnes minimum</p>
              <p class="m-0">
                Partagez un plat chaud entouré de vos être chers pour Noël
              </p>
            </div>

            <div class="menu-info-price">
              <p class="mb-0 mt-2">45 €/pers</p>
              <a href="" class="btn btn-primary">Détails</a>
            </div>
          </div>
        </div>

        <!-- ---------------------------CARD 2--------------------------------- -->
        <div class="card card-corner global-view-card p-0 bg-white">
          <div class="img-menu-card">
            <img
              class="forced-in-div shadow"
              src="<?= BASE_URL ?>/assets/pictures/fresh-product-key-point.jpg"
            />
          </div>

          <div class="p-4 display-info-menu">
            <div class="menu-info-text">
              <h2 class="m-0">Esprit de fête</h2>
              <p class="text-primary">2 personnes minimum</p>
              <p class="m-0">
                Partagez un plat chaud entouré de vos être chers pour Noël
              </p>
            </div>

            <div class="menu-info-price">
              <p class="mb-0 mt-2">45 €/pers</p>
              <a href="" class="btn btn-primary">Détails</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
