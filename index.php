<?php 
  ob_start();
  session_start();
  require "config/config.php";
  require "config/router.php"; 

  $currentPage = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $page = get_page();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/scss/main.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Vite Et Gourmand</title>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-md bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
          <a href="<?= BASE_URL ?>/">
            <img src="<?= BASE_URL ?>/assets/pictures/logo-light.png" class="logo-size-header" />
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
              <li class="nav-item">
                <a class="nav-link " href="<?= BASE_URL ?>/">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="<?= BASE_URL ?>/carteDesMenus">Carte des menus</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="<?= BASE_URL ?>/contact">Contact</a>
              </li>
              <?php if (isset($_SESSION['user_id']) && !isset($_SESSION['user_role'])): ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?= BASE_URL ?>/monCompte">Mon Compte</a>
                </li>
              <?php endif; ?> 
              <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_role'])): ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?= BASE_URL ?>/monCompteEmploye/InfosRestaurant">Mon compte</a>
                </li>
              <?php endif; ?> 
              <?php if (!isset($_SESSION['user_id'])): ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?= BASE_URL ?>/inscription">S'inscrire</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?= BASE_URL ?>/connexion">Se connecter</a>
                </li>
              <?php endif; ?> 
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <main id=<?= $currentPage === BASE_URL.'/commander' ? "main-page-order" : "main-page"; ?>>
      <?php require $page; ?>
    </main>
    
    
    <footer class="bg-dark text-white text-center footer">
      <?php require "pages/databaseLink/footerPost.php";?>
      <div class="row">
        <div class="col-6 col-md-4">
          <h2>Acces/Contact</h2>
          <p>
            12 rue de l’avenue </br>
            33000 Bordeaux</br></br>
            Si vous avez une question</br>
            <a href="<?= BASE_URL ?>/contact"> contactez nous </a>
          </p>
        </div>
        <div class="col-6 col-md-4">
          <h2>Horaire</h2>
          <p>
            Du lundi au samedi <br />
            <?= substr($horaires['1']['morning_opening'], 0, 5)?> – <?= substr($horaires['1']['morning_closing'], 0, 5)?><br />
            <?= substr($horaires['1']['night_opening'], 0, 5)?> – <?= substr($horaires['1']['night_closing'], 0, 5)?><br />
          </p>
          <p>
            Dimanche <br />
            <?= substr($horaires['2']['morning_opening'], 0, 5)?> – <?= substr($horaires['2']['morning_closing'], 0, 5)?><br /><br />
          </p>
        </div>
        <div class="col-12 col-md-4">
          <h2>A Propos</h2>
          <p>
            <a href="<?= BASE_URL ?>/contact"> notre equipe </a><br />
            <a href="<?= BASE_URL ?>/contact"> galerie </a><br />
            <a href="<?= BASE_URL ?>/contact"> mentions légales </a><br />
            <a href="<?= BASE_URL ?>/contact"> conditions de vente </a>
          </p>
        </div>
        <hr>
        <div class="col-12">
          <p class="copyright">&copy; 2026 - Vite & Gourmand | Tous droits réservés</p>
        </div>
      </div>
    </footer>
    <script src="<?= BASE_URL ?>/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/home.js"></script>
    <script type="module" src="<?= BASE_URL ?>/Router/router.js"></script>

  </body>
</html>
<?php ob_end_flush(); ?>


