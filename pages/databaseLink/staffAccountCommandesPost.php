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


  try {

    //Récupérer les utilisateurs 
    $query = "
      SELECT
        commandes.*, 
        users.prenom,
        users.nom,
        users.telephone,
        users.email,
        menus.titre
      FROM
        commandes
      JOIN users ON commandes.user_id = users.id
      JOIN menus ON commandes.menu_id = menus.id
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $commandes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $status_badge = [
      "accepte" => "text-bg-badge-accepte",
      "en_preparation" => "text-info",
      "en_cours_de_livraison" => "text-purple",
      "livre" => "text-teal",
      "restitution_materiel" => "text-warning",
      "terminee" => "text-success"
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteOrder'])) {
      $wayOfContactToDelete = $_POST['wayOfContactToDelete'];
      $reasonToDelete = $_POST['reasonToDelete'];
      $commandeId = $_POST['commandeIdToDelete'];

      if (empty(trim($reasonToDelete)))  {
        header("Location: $commandesPage?error=noReasonEnterded");
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

      header("Location: $commandesPage?success=commandeSupprime");
      exit;
    }

  } catch (PDOException $e){
    echo "Erreur de connexion à la base de données : ". $e->getMessage();
}
