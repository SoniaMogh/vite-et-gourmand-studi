<?php 
  require __DIR__ . "/../../config/database.php";
  $reviewsPage = BASE_URL . "/monCompteEmploye/staffAccountAvis";

  try {

    $query = "
      SELECT
        avis.*,
        users.nom,
        users.prenom
      FROM
        avis
      JOIN users ON avis.user_id = users.id
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $tousAvis = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accepteReview'])) {
      $reviewToUpdate = $_POST['reviewToUpdate'];
      $accepte = true;

      $query = "
        UPDATE
          avis
        SET
          status = :status
        WHERE
          id = :id
      ";
      $stmt = $pdo->prepare($query);
      $stmt->bindParam(':status', $accepte);
      $stmt->bindParam(':id', $reviewToUpdate);
      $stmt->execute();

      header("Location: $reviewsPage");
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hideReview'])) {
      $reviewToUpdate = $_POST['reviewToUpdate'];
      $hide = 0;

      $query = "
        UPDATE
          avis
        SET
          status = :status
        WHERE
          id = :id
      ";
      $stmt = $pdo->prepare($query);
      $stmt->bindParam(':status', $hide);
      $stmt->bindParam(':id', $reviewToUpdate);
      $stmt->execute();
      header("Location: $reviewsPage");
      exit;
    }



  } catch (PDOException $e){
    error_log($e->getMessage());
    echo "Erreur serveur";
    exit;
}