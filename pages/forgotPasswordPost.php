<?php
require __DIR__ . "/../config/database.php";
$location = BASE_URL . "/MotDePasseOublie";

try {
  //Récupérer les données du formulaire de connexion
  $forgotPasswordEmail = $_POST['forgotPasswordEmail'];

  //Récupérer les utilisateurs 
  $query = "SELECT * FROM users WHERE email = :forgotPasswordEmail";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':forgotPasswordEmail', $forgotPasswordEmail);
  $stmt->execute();

  //Est-ce que l’utilisateur (mail) existe ?
  if($stmt->rowCount() == 1){

?>

    <div id="messageSent-page">
      <h1>Le mail a bien envoyé</h1>
      <h3 class="text-primary">Si vous ne le voyez pas, attendez quelques minutes ou vérifier vos courriers indésirables</h3>
      <a href="<?= BASE_URL ?>/">Retourner à l'accueil</a>
    </div>

<?php 

  } else{
    header("Location: $location?error=emailNotFound");
    exit;

  }
} catch(PDOException $e) { 
  echo "Erreur de connexion à la base de données : ". $e->getMessage();
} ?>

