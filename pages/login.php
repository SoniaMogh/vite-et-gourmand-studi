<div id="connection-part">
  <div class="container py-5 ">
    <div class="row card p-0 p-xl-5 mx-5 mx-md-6 side-by-side card-corner">
      <div class="col-12 col-xl-6">
        <div class="col-12 text-center">
          <img
            src="<?= BASE_URL ?>/assets/pictures/logo-primary.png"
            alt="logo-v-et-g"
            class="form-logo-size"
          />
          <h1 class="text-primary pb-4">Se connecter</h1>
        </div>
        <form
          action="<?= BASE_URL ?>/loginPost"
          method="post"
          class="form-display"
        >
          <div class="col-10 ">
             <?php if (isset($_GET['error'])) { 
              if ($_GET['error'] === 'mailIncorrect') {
                echo "<p class='m-0 text-warning'>Utilisateur introuvable.</p>";
              }
            } ?>
            
            <input
              class="mb-2 form-control"
              type="email"
              id="connectionEmail"
              name="connectionEmail"
              placeholder="Email"
              required
            />
          </div>
          <div class="col-10">
            <?php if (isset($_GET['error'])) { 
              if ($_GET['error'] === 'mdpIncorrect') {
                echo "<p class='m-0 text-warning'>Mot de passe incorrect</p>";
              }
            } ?>
            <input
              class="form-control m-0"
              type="password"
              id="connectionPassword"
              name="connectionPassword"
              placeholder="Mot de passe"
              required
            />
          </div>
          <a class="pb-4" href="<?= BASE_URL ?>/MotDePasseOublie">Mot de passe oublié ?</a>
          <input
            type="submit"
            value="Se connecter"
            class="btn btn-primary large-button"
          />
        </form>
      </div>
      <div class="col-6 dont-show-the-pic">
          <img class="connection-forced-in-div"
            src="<?= BASE_URL ?>/assets/pictures/sign-pic.jpg"
          />
      </div>
    </div>
  </div>
</div>
