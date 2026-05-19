<?php 
  require __DIR__ . "/../../config/database.php";
  $commandesPage = BASE_URL . "/monCompteEmploye/menu";

try {

    //Récupérer les utilisateurs 
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


  } catch (PDOException $e){
    echo "Erreur de connexion à la base de données : ". $e->getMessage();
}