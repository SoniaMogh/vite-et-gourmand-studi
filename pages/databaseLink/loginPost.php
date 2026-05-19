<?php
session_start();
require __DIR__ . "/../../config/database.php";
$compteClient = BASE_URL . "/monCompte";
$compteEmploye = BASE_URL . "/monCompteEmploye/InfosRestaurant";

$connexion = BASE_URL . "/connexion";

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
      if(password_verify($connectionPassword, $user['password'])){

        //Creation de session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['prenom'];
        $_SESSION['user_surname'] = $user['nom'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];

        if ($user['role'] === "employe") {
          header("Location: $compteEmploye");
          exit;
        }

        header("Location: $compteClient");
        exit;
      }else{
        header("Location: $connexion?error=mdpIncorrect");
        exit;
      }
  }
  else{
        header("Location: $connexion?error=mailIncorrect");
        exit;
  }
}
catch (PDOException $e){
    echo "Erreur de connexion à la base de données : ". $e->getMessage();
}

?>