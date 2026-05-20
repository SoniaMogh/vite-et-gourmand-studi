<?php 
  require __DIR__ . "/../../config/database.php";
  $employesPage = BASE_URL . "/monCompteAdmin/employes";

try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $employeToDeleteId = $_POST['employeToDeleteId'];

      $stmt = $pdo->prepare("
        DELETE FROM users
        WHERE id = :employeToDeleteId
      ");
      $stmt->execute([
        'employeToDeleteId' => $employeToDeleteId,
      ]);
      header("Location: $employesPage");
      exit;
    }


  } catch (PDOException $e){
    var_dump("Erreur de connexion à la base de données : ". $e->getMessage());
}