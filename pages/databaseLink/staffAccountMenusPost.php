<?php 
  require __DIR__ . "/../../config/database.php";
  $menusPage = BASE_URL . "/monCompteEmploye/menus";

try {

    //Récupérer les menus 
    $query = "
      SELECT
        menus.*,

        entrees.titre AS entree_titre,
        entrees.description AS entree_description,

        plats.titre AS plat_titre,
        plats.description AS plat_description,

        desserts.titre AS dessert_titre,
        desserts.description AS dessert_description
        
      FROM
        menus
      JOIN entrees ON menus.entree_id = entrees.id
      JOIN plats ON menus.plat_id = plats.id
      JOIN desserts ON menus.dessert_id = desserts.id

    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteMenubtn'])) {
      $deleteMenuId = $_POST['deleteMenuId'];

      $stmt = $pdo->prepare("
        DELETE FROM menus
        WHERE id = :deleteMenuId
      ");
      $stmt->execute([
        'deleteMenuId' => $deleteMenuId
      ]);
      header("Location: $menusPage");
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editMenubtn'])) {

    $idMenu = $_POST['editMenuId'];

    $titreMenu = $_POST['editTitreMenu'];
    $descriptionMenu = $_POST['editDescriptionMenu'];
    $nbrePersMin = $_POST['editNbrePersMin'];
    $prixPers = $_POST['editPrixPers'];
    $quantiteMenu = $_POST['editQuantiteMenu'];
    $regimeMenu = $_POST['editRegimeMenu'];
    $themeMenu = $_POST['editThemeMenu'];
    $entreeMenu = $_POST['editEntreeMenu'];
    $platMenu = $_POST['editPlatMenu'];
    $dessertMenu = $_POST['editDessertMenu'];

    // Gestion de l'image
    if (!empty($_FILES['imageMenu']['name'])) {

        $targetDir = __DIR__ . "/../../assets/pictures/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = uniqid() . "_" . basename($_FILES["imageMenu"]["name"]);
        $targetFile = $targetDir . $fileName;

        move_uploaded_file($_FILES["imageMenu"]["tmp_name"], $targetFile);

        $dbPath = "assets/pictures/" . $fileName;

        $stmtEdit = $pdo->prepare("
            UPDATE menus
            SET
                titre = :titre,
                entree_id = :entree_id,
                plat_id = :plat_id,
                dessert_id = :dessert_id,
                nbre_pers_min = :nbre_pers_min,
                prix_par_pers = :prix_par_pers,
                regime_id = :regime_id,
                theme_id = :theme_id,
                description = :description,
                quantite_restante = :quantite_restante,
                img_path = :img_path
            WHERE id = :id
        ");

        $stmtEdit->execute([
            'titre' => $titreMenu,
            'entree_id' => $entreeMenu,
            'plat_id' => $platMenu,
            'dessert_id' => $dessertMenu,
            'nbre_pers_min' => $nbrePersMin,
            'prix_par_pers' => $prixPers,
            'regime_id' => $regimeMenu,
            'theme_id' => $themeMenu,
            'description' => $descriptionMenu,
            'quantite_restante' => $quantiteMenu,
            'img_path' => $dbPath,
            'id' => $idMenu
        ]);

    } else {
        // On ne modifie pas l'image
        $stmt = $pdo->prepare("
            UPDATE menus
            SET
                titre = :titre,
                entree_id = :entree_id,
                plat_id = :plat_id,
                dessert_id = :dessert_id,
                nbre_pers_min = :nbre_pers_min,
                prix_par_pers = :prix_par_pers,
                regime_id = :regime_id,
                theme_id = :theme_id,
                description = :description,
                quantite_restante = :quantite_restante
            WHERE id = :id
        ");

        $stmt->execute([
            'titre' => $titreMenu,
            'entree_id' => $entreeMenu,
            'plat_id' => $platMenu,
            'dessert_id' => $dessertMenu,
            'nbre_pers_min' => $nbrePersMin,
            'prix_par_pers' => $prixPers,
            'regime_id' => $regimeMenu,
            'theme_id' => $themeMenu,
            'description' => $descriptionMenu,
            'quantite_restante' => $quantiteMenu,
            'id' => $idMenu
        ]);
    }

    header("Location: $menusPage");
    exit;
}

  } catch (PDOException $e){
    error_log($e->getMessage());
    echo "Erreur serveur";
    exit;
}