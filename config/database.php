<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); 
$dotenv->load();

$host = $_ENV["DB_HOST"];
$dbname = $_ENV["DB_NAME"];
$user = $_ENV["DB_USER"];
$password = $_ENV["DB_PASSWORD"];

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname",
        $user,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    var_dump( "Erreur connexion : ");
}