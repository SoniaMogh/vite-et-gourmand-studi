<?php 
  require __DIR__ . "/../../config/database.php";
  $commandesPage = BASE_URL . "/monCompteEmploye/commandes";


  try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $commandeId = $_POST['orderTrackingAccepte'];

      if (!empty($commandeId)){

        $stmt2 = $pdo->prepare("
            UPDATE commandes
            SET status = :status
            WHERE id = :id
        ");

        $stmt2->execute([
          'status' => "accepte",
          'id' => $commandeId
        ]);

        $stmt = $pdo->prepare("
          INSERT INTO suivis_commandes (commande_id, accepte)
          VALUES (:id, NOW())
        ");

        $stmt->execute([
          'id' => $commandeId
        ]);
        header("Location: $commandesPage?success=$commandeId");
        exit;
      } else {

        header("Location: $commandesPage?error=noId");
        exit;
      }
    
    }

  } catch (PDOException $e){
    echo "Erreur de connexion à la base de données : ". $e->getMessage();
}
