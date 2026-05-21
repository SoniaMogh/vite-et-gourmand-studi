<?php
require __DIR__ . "/../../config/database.php";

try{
  //Récupérer les horaires
  $query = "SELECT * FROM horaires";
  $stmt = $pdo->prepare($query);
  $stmt->execute();

  $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $horaires = array_column($datas, null, 'id');
}
catch (PDOException $e){
    error_log("Erreur de connexion à la base de données : ". $e->getMessage());
}

?>