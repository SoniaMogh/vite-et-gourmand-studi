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

    if ($uri === "/messageSent") {
      return "pages/messageSent.php";
    }

    if (preg_match("#^formations/([^/]+)$#", $uri, $matches)) {
      $GLOBALS['slug'] = $matches[1];
      return "pages/formation.php";
    }

    return "pages/404.php";
}