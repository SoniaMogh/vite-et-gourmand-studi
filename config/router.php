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
      return "pages/databaseLink/contactPost.php";
    }

    if ($uri === "/carteDesMenus") {
      return "pages/globalMenuView.php";
    }

    if ($uri === "/connexion") {
      return "pages/login.php";
    }

    if ($uri === "/loginPost") {
      return "pages/databaseLink/loginPost.php";
    }

    if ($uri === "/inscription") {
      return "pages/signup.php";
    }

    if ($uri === "/signupPost") {
      return "pages/databaseLink/signupPost.php";
    }

    if ($uri === "/MotDePasseOublie") {
      return "pages/forgotPassword.php";
    }

    if ($uri === "/MotDePasseOublieMailEnvoye") {
      return "pages/databaseLink/forgotPasswordPost.php";
    }

    if ($uri === "/commander") {
      return "pages/commander.php";
    }

    if ($uri === "/commanderPost") {
      return "pages/databaseLink/commanderPost.php";
    }

    if ($uri === "/monCompte") {
      return "pages/userAccountProfile.php";
    }

    if ($uri === "/monComptePost") {
      return "pages/databaseLink/userAccountProfilePost.php";
    }

    if ($uri === "/monCompte/mesCommandes") {
      return "pages/userAccountMesCommandes.php";
    }

    // ---------------------------- COMPTE EMPLOYE ----------------------------------------

    if ($uri === "/monCompteEmploye/InfosRestaurant") {
      return "pages/staffAccountRestaurantInfos.php";
    }

    if ($uri === "/monCompteEmploye/InfosRestaurantPost") {
      return "pages/databaseLink/staffAccountRestaurantInfosPost.php";
    }

    if ($uri === "/monCompteEmploye/menus") {
      return "pages/staffAccountMenus.php";
    }

    if ($uri === "/monCompteEmploye/menusPost") {
      return "pages/databaseLink/staffAccountMenusPost.php";
    }

    if ($uri === "/monCompteEmploye/commandes") {
      return "pages/staffAccountCommandes.php";
    }

    if ($uri === "/monCompteEmploye/commandesPost") {
      return "pages/databaseLink/staffAccountCommandesPost.php";
    }

    if ($uri === "/monCompteEmploye/accepteCommandesPost") {
      return "pages/databaseLink/staffAccountAccepteCommandesPost.php";
    }

    if ($uri === "/monCompteEmploye/staffAccountAddMenu") {
      return "pages/staffAccountAddMenu.php";
    }

    if ($uri === "/monCompteEmploye/staffAccountAddMenuPost") {
      return "pages/databaseLink/staffAccountAddMenusPost.php";
    }

    if ($uri === "/monCompteEmploye/staffAccountAvis") {
      return "pages/staffAccountAvis.php";
    }

    if ($uri === "/monCompteEmploye/staffAccountAvisPost") {
      return "pages/databaseLink/staffAccountAvisPost.php";
    }

    if ($uri === "/logout") {
      return "pages/logout.php";
    }

    return "pages/404.php";
}