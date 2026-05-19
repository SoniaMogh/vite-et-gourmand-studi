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
      $menu_id_to_delete = $_POST['deleteMenuId'];

      $stmt = $pdo->prepare("
        DELETE FROM menus
        WHERE id = :menu_id_to_delete
      ");
      $stmt->execute([
        'menu_id_to_delete' => $menu_id_to_delete,
      ]);
      header("Location: $menusPage?success");
      exit;
    }


  } catch (PDOException $e){
    var_dump("Erreur de connexion à la base de données : ". $e->getMessage());
}