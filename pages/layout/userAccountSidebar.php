<?php $currentPage = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>

<div class="userAccountSidebar card card-corner me-5">
  <div class="text-center">
    <img
      src="<?= BASE_URL ?>/assets/pictures/logo-light.png"
      alt="logo-v-et-g"
      class="form-logo-size"
    />
  </div>

  <div class="nav link-sidebar sidebar-top">
    <!-- sidebar avec bouton en colonne-->

    <a href="<?= BASE_URL ?>/" class="sidebar-link my-0 py-2 text-decoration-none p-3">
      <i class="bi bi-house text-light me-1"></i>
      <span class="hide-on-collapse text-light">Accueil</span>
    </a>
    <a href="<?= BASE_URL ?>/carteDesMenus" class="sidebar-link my-0 py-2 text-decoration-none p-3">
      <i class="bi bi-postcard text-light me-1"></i>
      <span class="hide-on-collapse text-light">Carte des menus</span>
    </a>

    <hr class="text-light" />

    <a href="<?= BASE_URL ?>/monCompte" class="sidebar-link py-2 my-0 text-decoration-none <?= $currentPage === BASE_URL.'/monCompte' ? 'active' : ''; ?> p-3">
      <i class="bi bi-person text-light me-1"></i>
      <span class="hide-on-collapse text-light">Profile</span>
    </a>

    <a href="<?= BASE_URL ?>/monCompte/mesCommandes" class="sidebar-link py-2 my-0 text-decoration-none <?= $currentPage === BASE_URL.'/monCompte/mesCommandes' ? 'active' : ''; ?> p-3">
      <i class="bi bi-cart text-light me-1"></i>
      <span class="hide-on-collapse text-light">Mes commandes</span>
    </a>
  </div>

  <div class="nav link-sidebar sidebar-bottom">
    <a href="<?= BASE_URL ?>/contact" class="sidebar-link py-2 my-0 text-decoration-none p-3">
      <i class="bi bi-headphones text-light me-1"></i>
      <span class="hide-on-collapse text-light">Nous contacter</span>
    </a>
    <a href="<?= BASE_URL ?>/monCompte/logout" class="sidebar-link py-2 my-0 text-decoration-none p-3">
      <i class="bi bi-door-open text-light me-1"></i>
      <span class="hide-on-collapse text-light">Se déconnecter</span>
    </a>
  </div>
</div>