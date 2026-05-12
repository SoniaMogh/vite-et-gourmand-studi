<div id="connection-part">
  <div class="container py-5 ">
    <div class="row card p-5 mx-5 mx-md-6 side-by-side card-corner">
      <div class="col-6">
        <div class="col-12 text-center">
          <img
            src="<?= BASE_URL ?>/assets/pictures/logo-primary.png"
            alt="logo-v-et-g"
            class="form-logo-size"
          />
          <h1 class="text-primary pb-4">Créez votre compte</h1>
        </div>
        <form
          action="<?= BASE_URL ?>/signupPost"
          method="post"
          class="form-display"
        >
          <div class="mb-2 col-10 signup-wrapper">
            <input
              class="form-control m-0"
              type="text"
              id="signupName"
              name="signupName"
              placeholder="Nom"
              required
            />
            <input
              class="form-control m-0"
              type="text"
              id="signupSurname"
              name="signupSurname"
              placeholder="Prénom"
              required
            />
          </div>
          <div class="mb-2 col-10">
            <input
              class="form-control m-0"
              type="tel"
              id="signupTel"
              name="signupTel"
              placeholder="Numéro de téléphone"
              pattern="0[1-9]{9}"
              required
            />
          </div>
          <div class="mb-2 col-10">
            <input
              class="form-control m-0"
              type="email"
              id="signupEmail"
              name="signupEmail"
              placeholder="Email"
              required
            />
          </div>
          <div class="mb-2 col-10">
            <input
              class="form-control m-0"
              type="text"
              id="signupAdress"
              name="signupAdress"
              placeholder="Adresse"
              required
            />
          </div>
          <div class="mb-2 col-10 signup-wrapper">
            <input
              class="form-control m-0"
              type="text"
              id="signupZIP"
              name="signupZIP"
              placeholder="Code postal"
              inputmode="numeric"
              pattern="[0-9]{5}"
              required
            />
            <input
              class="form-control m-0"
              type="text"
              id="signupCity"
              name="signupCity"
              placeholder="Ville"
              required
            />
          </div>
          <div class="mb-2 col-10 d-flex align-items-center gap-2">
            <input
              class="form-control m-0"
              type="password"
              id="signupPassword"
              name="signupPassword"
              placeholder="Mot de passe"
              autocomplete="new-password"
              minlength="10"
              pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{10,}"
              required
            /> 
            <i 
              class="bi bi-question-circle" 
              data-bs-toggle="tooltip" 
              data-bs-placement="top"
              data-bs-html="true"
              title="Votre mot de passe doit contenir: au moins 10 caractères dont un caractère spécial, une majuscule, une minuscule et un chiffre."
            >
            </i>
          </div>
          <div class="col-10">
            <input
              class="form-control
              <?php if (isset($_GET['error'])) { 
                if ($_GET['error'] === 'mdpNotConfirmed') {
                    echo "m-0";
                }
              } ?>
              "
              type="password"
              id="signupCheckPassword"
              name="signupCheckPassword"
              placeholder="Confirmer le mot de Passe"
              required
            />
          </div>
          <!-- message d'erreur si le mdp ne correspond pas à la confirmation -->
          <?php if (isset($_GET['error'])) { 
            if ($_GET['error'] === 'mdpNotConfirmed') {
                echo "<p class='text-warning m-0'>Votre mot de passe ne correspond pas.</p>";
            }
          } ?>

          <input
            type="submit"
            value="S'inscrire"
            class="mb-0 mt-4 btn btn-primary large-button"
          />
          <a href="<?= BASE_URL ?>/connexion">Vous avez déjà un compte ?</a>
        </form>
      </div>
      <div class="col-6">
          <img class="connection-forced-in-div"
            src="<?= BASE_URL ?>/assets/pictures/sign-pic.jpg"
          />
      </div>
    </div>
  </div>
</div>
