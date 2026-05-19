<?php 
  require __DIR__ . "/../../config/database.php";
  $commandesPage = BASE_URL . "/monCompteEmploye/commandes";


  try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accepteOrderbtn'])) {
      $commandeId = $_POST['orderTrackingAccepte'];

      if (!empty($commandeId)){


        $stmt = $pdo->prepare("
          INSERT INTO suivis_commandes (commande_id, accepte)
          VALUES (:id, :todayDate)
        ");

        $todayDate = (new DateTime())->format('Y-m-d H:i:s');

        $stmt->execute([
          'id' => $commandeId,
          'todayDate' => $todayDate
        ]);

        $stmt2 = $pdo->prepare("
            UPDATE commandes
            SET status = :status
            WHERE id = :id
        ");

        $stmt2->execute([
          'status' => "accepte",
          'id' => $commandeId
        ]);
        header("Location: $commandesPage");
        exit;
      } else {

        header("Location: $commandesPage?error=noId");
        exit;
      }
    
    }

  } catch (PDOException $e){
    var_dump( "Erreur de connexion à la base de données : ". $e->getMessage());
}
