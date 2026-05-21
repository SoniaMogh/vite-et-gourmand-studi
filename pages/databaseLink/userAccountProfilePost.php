<?php

require __DIR__ . "/../../config/database.php";
$account = BASE_URL . "/monCompte";

try{

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updatePersonalInfos'])) {

    //Récupérer les données du formulaire de modification des infos personnelles
    $updateName = $_POST['updateName'];
    $updateSurname = $_POST['updateSurname'];
    $updateTel = $_POST['updateTel'];
    $updateEmail = $_POST['updateEmail'];
    $updateAdress = $_POST['updateAdress'];
    $updateZIP = $_POST['updateZIP'];
    $updateCity = $_POST['updateCity'];
    $updateBirthday = $_POST['updateBirthday'] ? $_POST['updateBirthday'] : null;


    $queryUpdateUserInfos = "
      UPDATE 
        users
      SET 
        nom = :surname,
        prenom = :name,
        telephone = :tel,
        email = :email,
        adresse = :adress,
        code_postal = :zip,
        ville = :city,
        birthday = :birthday
      WHERE 
        id = :id
    ";

    $stmt = $pdo->prepare($queryUpdateUserInfos);
    $stmt->bindParam(':surname', $updateSurname);
    $stmt->bindParam(':name', $updateName);
    $stmt->bindParam(':tel', $updateTel);
    $stmt->bindParam(':email', $updateEmail);
    $stmt->bindParam(':adress', $updateAdress);
    $stmt->bindParam(':zip', $updateZIP);
    $stmt->bindParam(':city', $updateCity);
    $stmt->bindParam(':birthday', $updateBirthday);
    $stmt->bindParam(':id', $_SESSION['user_id']);
    $stmt->execute();

    header("Location: $account?success=saved");
    exit;
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateDetailPayment'])) {

        header("Location: $account?success=saved");
    exit;
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['changePassword'])) {

    //Récupérer les données du formulaire de modification des infos personnelles
    $oldPasswordToUpdate = $_POST['oldPasswordToUpdate'];
    $newPasswordToUpdate = $_POST['newPasswordToUpdate'];

    //Récupérer l'utilisateur
    $query = "
      SELECT * 
      FROM users 
      WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $_SESSION['user_id']);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if(password_verify($oldPasswordToUpdate, $user['password'])){
      $hashedPassword = password_hash($newPasswordToUpdate, PASSWORD_DEFAULT);

      $queryUpdatePassword = "
        UPDATE 
          users
        SET 
          password = :new_password
        WHERE 
          id = :id
      ";

      $stmt = $pdo->prepare($queryUpdatePassword);
      $stmt->bindParam(':new_password', $hashedPassword);
      $stmt->bindParam(':id', $user['id']);
      $stmt->execute();

      header("Location: $account?success=saved");
      exit;
    }
  }

}
catch (PDOException $e){
    error_log($e->getMessage());
    echo "Erreur serveur";
    exit;
}

?>