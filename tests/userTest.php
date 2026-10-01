<?php

use PHPUnit\Framework\TestCase;

require __DIR__ . '/../models/User.php';

class userTest extends TestCase
{
  public function testPasswordHash()
  {

    echo "\ntestPasswordHash en cours\n";
    $password = "password123";

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $this->assertTrue(password_verify($password, $hash));
  }

  public function testWrongPassword()
  {
    echo "\ntestWrongPassword en cours. Supposé fail\n";
    $password = "password123";

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $this->assertTrue(password_verify("password456", $hash));
  }

  public function testCreateUser()

  {
    echo "\ntestCreateUser en cours\n";
    require __DIR__ . '/../config/database.php';

    $userModel = new User($pdo);
    $email = 'test_phpunit@example.com';

    // On supprime l'ancien utilisateur de test s'il existe
    $delete = $pdo->prepare(
      "DELETE FROM users WHERE email = :email"
    );
    $delete->execute(['email' => $email]);

    // Création de l'utilisateur
    $userId = $userModel->createUser(
      'Tom',
      'Test',
      '0601020304',
      $email,
      '1 rue de Test',
      '75001',
      'Paris',
      'password123',
      null
    );

    // On vérifie qu'un ID, un utilisateur a bien été créé (puisqu'on retourne le dernier id ajouté)
    $this->assertNotEmpty($userId);

    echo "Un Id existe\n";

    // On vérifie que c'est le bon utilisateur qui a été créé
    $stmt = $pdo->prepare(
      "SELECT * FROM users WHERE id = :id"
    );
    $stmt->execute(['id' => $userId]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // On vérifie que l'utilisateur existe réellement
    $this->assertNotFalse($user);

    echo "Notre utilisateur a bien été créé\n";

    // On vérifie quelques données de l'utilisateur
    $this->assertSame('Tom', $user['nom']);
    $this->assertSame($email, $user['email']);

    echo "Les informations de notre utilisateur sont correctes\n";

    // On supprime l'utilisateur créé par le test
    $delete = $pdo->prepare(
      "DELETE FROM users WHERE id = :id"
    );
    $delete->execute(['id' => $userId]);
  }
}

