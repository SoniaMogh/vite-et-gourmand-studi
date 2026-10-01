<?php

class User 
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function createUser(
    $signupName,
    $signupSurname,
    $signupTel,
    $signupEmail,
    $signupAdress,
    $signupZIP,
    $signupCity,
    $signupPassword,
    $role
  ){

    $hashedPassword = password_hash($signupPassword, PASSWORD_DEFAULT);
    
    //Ajouter l'utilisateurs
    $query = "
      INSERT INTO users (nom, prenom, telephone, email, adresse, code_postal, ville, password, role) 
      VALUES (:name, :surname, :tel, :email, :adress, :zip, :city, :password, :role)";

    $stmt = $this->pdo->prepare($query);

    $stmt->bindParam(':surname', $signupSurname);
    $stmt->bindParam(':tel', $signupTel);
    $stmt->bindParam(':name', $signupName);
    $stmt->bindParam(':email', $signupEmail);
    $stmt->bindParam(':adress', $signupAdress);
    $stmt->bindParam(':zip', $signupZIP);
    $stmt->bindParam(':city', $signupCity);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':role', $role);
    $stmt->execute();
    
    return $this->pdo->lastInsertId();// Permet de récupérer le dernier id inséré
  }

  public function findIfUserExistWithEmail($mail){
    //Récupérer les utilisateurs avec le mail entré
    $checkUser = "SELECT * FROM users WHERE email = :email";
    $stmt = $this->pdo->prepare($checkUser);
    $stmt->bindParam(':email', $mail);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);

  }


}