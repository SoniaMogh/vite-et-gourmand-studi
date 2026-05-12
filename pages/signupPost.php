<?php
require __DIR__ . "/../config/database.php";
$location = BASE_URL . "/contact";

try{
  //Récupérer les données du formulaire de connexion
  $signupName = $_POST['signupName'];
  $signupSurname = $_POST['signupSurname'];
  $signupTel = $_POST['signupTel'];
  $signupEmail = $_POST['signupEmail'];
  $signupAdress = $_POST['signupAdress'];
  $signupZIP = $_POST['signupZIP'];
  $signupCity = $_POST['signupCity'];
  $signupPassword = $_POST['signupPassword'];


  //Récupérer les utilisateurs 
  $checkUser = "SELECT * FROM users WHERE email = :signupEmail";
  $stmt = $pdo->prepare($checkUser);
  $stmt->bindParam(':signupEmail', $signupEmail);
  $stmt->execute();
  //Est-ce que l’utilisateur (mail) existe ?
  if($stmt->rowCount() > 0){
      die("Cette adresse email est déjà utilisée");
  }

  $hashedPassword = password_hash($signupPassword, PASSWORD_DEFAULT);

  //ajouter l'utilisateurs 
  $saveUser = "
    INSERT INTO users (nom, prenom, telephone, email, adresse, code_postal, ville, password) 
    VALUES (:name, :surname, :tel, :email, :adress, :zip, :city, :password)";
  $stmt2 = $pdo->prepare($saveUser);
  $stmt2->bindParam(':surname', $signupSurname);
  $stmt2->bindParam(':tel', $signupTel);
  $stmt2->bindParam(':name', $signupName);
  $stmt2->bindParam(':email', $signupEmail);
  $stmt2->bindParam(':adress', $signupAdress);
  $stmt2->bindParam(':zip', $signupZIP);
  $stmt2->bindParam(':city', $signupCity);
  $stmt2->bindParam(':password', $hashedPassword);
  $stmt2->execute();
  header("Location: $location");
  exit;

}
catch (PDOException $e){
  echo "Erreur de connexion à la base de données : ". $e->getMessage();
}

?>