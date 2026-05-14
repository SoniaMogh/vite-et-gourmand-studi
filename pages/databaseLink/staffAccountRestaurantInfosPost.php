<?php
require __DIR__ . "/../../config/database.php";
$location = BASE_URL . "/monCompte";

try{
  //Récupérer les horaires
  $query = "SELECT * FROM horaires";
  $stmt = $pdo->prepare($query);
  $stmt->execute();

  $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $horaires = [];

  foreach ($datas as $data) {
    $horaires[$data['jour']] = $data;
  };

}
catch (PDOException $e){
    echo "Erreur de connexion à la base de données : ". $e->getMessage();
}

?>