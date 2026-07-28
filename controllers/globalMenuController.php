<?php

require __DIR__ . "/../config/database.php";
require __DIR__ . "/../models/Menu.php";

$isConnected = isset($_SESSION['user_id']);
$mailIncorrect = isset($_GET['error']) && $_GET['error'] === 'mailIncorrect';
$mdpIncorrect = isset($_GET['error']) && $_GET['error'] === 'mdpIncorrect';

$menuModel = new Menu($pdo);

$menus = $menuModel-> getAllMenuInfos();
foreach ($menus as &$menu) { //& dit que $menu est relié à $menus
    $menu['entree_allergenes'] = 
      $menuModel->getEntreeAllergenes($menu['entree_id']);
    $menu['plat_allergenes'] = 
      $menuModel->getPlatAllergenes($menu['plat_id']);
    $menu['dessert_allergenes'] = 
      $menuModel->getDessertAllergenes($menu['dessert_id']);
}
unset($menu);

require __DIR__ . "/../views/globalMenuView2.php";