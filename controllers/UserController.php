<?php

require __DIR__ . "/../models/User.php";
require __DIR__ . "/../config/database.php";

$inscription = BASE_URL . "/inscription";
$location = BASE_URL . "/monCompte";

$signupName = $_POST['signupName'];
$signupSurname = $_POST['signupSurname'];
$signupTel = $_POST['signupTel'];
$signupEmail = $_POST['signupEmail'];
$signupAdress = $_POST['signupAdress'];
$signupZIP = $_POST['signupZIP'];
$signupCity = $_POST['signupCity'];
$signupPassword = $_POST['signupPassword'];
$signupCheckPassword = $_POST['signupCheckPassword'];
$role = $_POST['role'] ?? null;

$userModel = new User($pdo);

try{

  //Vérifier que les mdp passe et la confirmation de mdp correspondent
    if ($signupPassword !== $signupCheckPassword) {
      header("Location: $inscription?error=mdpNotConfirmed");
      exit;
    };

  // Vérifier si l'email existe déjà
  $existingUser = $userModel->findIfUserExistWithEmail($signupEmail);

  if ($existingUser) {
      header("Location: $inscription?error=emailAlreadyExist");
      exit;
  }

  $lastId = $userModel->createUser(
    $signupName,
    $signupSurname,
    $signupTel,
    $signupEmail,
    $signupAdress,
    $signupZIP,
    $signupCity,
    $signupPassword,
    $role
  );

  //Creation de session
  $_SESSION['user_id'] = $lastId;
  $_SESSION['user_name'] = $signupName;
  $_SESSION['user_surname'] = $signupSurname;
  $_SESSION['user_email'] = $signupEmail;
  header("Location: $location");
  exit;


} catch(PDOException $e){
    error_log($e->getMessage());
    echo "Erreur serveur";
    exit;
}