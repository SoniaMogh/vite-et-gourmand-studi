<?php 
  require __DIR__ . "/../../config/database.php";

  //Récupérer les utilisateurs 
  $query = "
    SELECT
      commandes.*, 
      users.*,
      menus.titre
    FROM
      commandes
    JOIN users ON commandes.user_id = users.id
    JOIN menus ON commandes.menu_id = menus.id
  ";
  $stmt = $pdo->prepare($query);
  $stmt->execute();

  $commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);