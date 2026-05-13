<?php
  function get_page() {
    //On recupere l'url et on le format
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = trim($uri, "/");

    // On ne veut recuperer que le nom de la page
    $base = "vite-et-gourmand-studi";
    if (str_starts_with($uri, $base)) {
      $uri = substr($uri, strlen($base)); 
    }

    // Systeme de routage
    if ($uri === "") {
      return "pages/home.php";
    }

    if ($uri === "/contact") {
      return "pages/contact.php";
    }

    if ($uri === "/messageEnvoye") {
      return "pages/contactPost.php";
    }

    if ($uri === "/carteDesMenus") {
      return "pages/globalMenuView.php";
    }

    if ($uri === "/connexion") {
      return "pages/login.php";
    }

    if ($uri === "/loginPost") {
      return "pages/loginPost.php";
    }

    if ($uri === "/inscription") {
      return "pages/signup.php";
    }

    if ($uri === "/signupPost") {
      return "pages/signupPost.php";
    }

    if ($uri === "/MotDePasseOublie") {
      return "pages/forgotPassword.php";
    }

    if ($uri === "/MotDePasseOublieMailEnvoye") {
      return "pages/forgotPasswordPost.php";
    }

    if ($uri === "/monCompte") {
      return "pages/userAccountProfile.php";
    }

    if (preg_match("#^formations/([^/]+)$#", $uri, $matches)) {
      $GLOBALS['slug'] = $matches[1];
      return "pages/formation.php";
    }

    return "pages/404.php";
}