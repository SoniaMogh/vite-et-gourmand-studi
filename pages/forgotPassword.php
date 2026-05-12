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
          <h1 class="text-primary mb-0">Mot de passe oublié ?</h1>
          <p class="pb-4">Un lien par mail vous sera envoyé afin de le réinitialier</p>
        </div>
        <form
          action="<?= BASE_URL ?>/MotDePasseOublieMailEnvoye"
          method="post"
          class="form-display"
        >
        <!-- message d'erreur si le mail n'existe pas dans la base de donnée -->
          <?php if (isset($_GET['error'])) { 
            if ($_GET['error'] === 'emailNotFound') {
                echo "<p class='text-warning m-0'>Votre mail ne correspond à aucun compte</p>";
            }
          } ?>
          <div class="mb-2 col-10">
            <input
              class="form-control m-0"
              type="email"
              id="forgotPasswordEmail"
              name="forgotPasswordEmail"
              placeholder="Email"
              required
            />
          </div>

          <input
            type="submit"
            value="Envoyer le mail"
            class="mb-0 mt-4 btn btn-primary large-button"
          />
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
