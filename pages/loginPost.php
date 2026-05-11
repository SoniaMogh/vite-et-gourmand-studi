<?php
require __DIR__ . "/../config/database.php";
$location = $location = BASE_URL . "/contact";

try{
  //Récupérer les données du formulaire de connexion
  $connectionEmail = $_POST['connectionEmail'];
  $connectionPassword = $_POST['connectionPassword'];

  //Récupérer les utilisateurs 
  $query = "SELECT * FROM users WHERE email = :connectionEmail";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':connectionEmail', $connectionEmail);
  $stmt->execute();

  //Est-ce que l’utilisateur (mail) existe ?
  if($stmt->rowCount() == 1){
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      if($connectionPassword == $user['password']){
          header("Location: $location");
exit;
      }else{
          echo "Mot de passe incorrect";
      }
  }
  else{
      echo "Utilisateur introuvable, êtes-vous sûr de votre mail ?";
  }
}
catch (PDOException $e){
    echo "Erreur de connexion à la base de données : ". $e->getMessage();
}

?>