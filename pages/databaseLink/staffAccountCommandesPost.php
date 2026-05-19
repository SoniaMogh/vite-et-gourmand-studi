<?php 
  require __DIR__ . "/../../config/database.php";
  $commandesPage = BASE_URL . "/monCompteEmploye/commandes";

  function getStatusColor($status) {
    $status_badge = [
      "accepte" => "text-bg-badge-accepte",
      "en_preparation" => "bg-info",
      "en_cours_de_livraison" => "bg-purple",
      "livre" => "bg-teal",
      "restitution_materiel" => "bg-warning",
      "terminee" => "bg-success",
      "annule" => "bg-danger"
    ];

    return $status_badge[$status] ?? 'text-bg-badge-waiting';
  }

  function getStatusName($status) {
    $stepsLabel = [
      "accepte" => "Accepté",
      "en_preparation" => "En préparation",
      "en_cours_de_livraison" => "En cours de livraison",
      "livre" => "Livré",
      "restitution_materiel" => "Restitution du matériel",
      "terminee" => "Terminé",
      "annule" => "Annulé"
    ];  

    return $stepsLabel[$status] ?? 'text-bg-badge-waiting';
  }

  try {

    //Récupérer les commandes et informations relié
    $query = "
      SELECT
        commandes.*, 
        suivis_commandes.accepte,
        suivis_commandes.en_preparation,
        suivis_commandes.en_cours_de_livraison,
        suivis_commandes.livre,
        suivis_commandes.restitution_materiel,
        suivis_commandes.terminee,
        users.prenom,
        users.nom,
        users.telephone,
        users.email,
        menus.titre
      FROM
        commandes
      JOIN users ON commandes.user_id = users.id
      JOIN menus ON commandes.menu_id = menus.id
      LEFT JOIN suivis_commandes 
        ON suivis_commandes.commande_id = commandes.id
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['changeStatusOrderbtn'])) {
      $steps = [
        "accepte",
        "en_preparation",
        "en_cours_de_livraison",
        "livre",
        "restitution_materiel",
        "terminee"
      ];
      $commandeId = $_POST['orderTrackingToUpdate'];

      // récupérer état actuel
      $stmt = $pdo->prepare("
          SELECT *
          FROM suivis_commandes
          WHERE commande_id = :id
      ");

      $stmt->execute(['id' => $commandeId]);
      $suivisDate = $stmt->fetch(PDO::FETCH_ASSOC) ?? [];

      $nextStep = null;
      

      foreach ($steps as $step) {
        if (!isset($suivisDate[$step]) || $suivisDate[$step] === null) {
            $nextStep = $step;
            break;
        }
      }
    
      if ($nextStep) {

        if (!in_array($nextStep, $steps)) {
            die("Invalid step");
        }

        $stmt = $pdo->prepare("
            UPDATE suivis_commandes
            SET $nextStep = NOW()
            WHERE commande_id = :id
        ");

        $stmt->execute(['id' => $commandeId]);

        $stmt2 = $pdo->prepare("
          UPDATE commandes
          SET status = :status
          WHERE id = :id
        ");

        $stmt2->execute([
          'status' => $nextStep,
          'id' => $commandeId
        ]);
      }

      header("Location: $commandesPage");
      exit;
    
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteOrderbtn'])) {
      $wayOfContactToDelete = $_POST['wayOfContactToDelete'];
      $reasonToDelete = $_POST['reasonToDelete'];
      $commandeId = $_POST['commandeIdToDelete'];

      if (empty(trim($reasonToDelete)))  {
        header("Location: $commandesPage?error=noReasonEntered");
        exit;
      }

      $queryDeleting = "
        UPDATE
          commandes
        SET
          status = 'annule',
          contact_annulation = :contact_delete,
          raison_annulation = :reason_delete
        WHERE
          id = :id_to_delete
      ";
      $stmt2 = $pdo->prepare($queryDeleting);
      $stmt2->bindParam(':contact_delete', $wayOfContactToDelete);
      $stmt2->bindParam(':reason_delete', $reasonToDelete);
      $stmt2->bindParam(':id_to_delete', $commandeId);
      $stmt2->execute();

      header("Location: $commandesPage");
      exit;
    }



  } catch (PDOException $e){
    echo "Erreur de connexion à la base de données : ". $e->getMessage();
}
