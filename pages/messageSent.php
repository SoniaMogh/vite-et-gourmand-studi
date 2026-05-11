<?php
require __DIR__ . "/../config/database.php";

try {
  $reasonContact= $_POST['reason-contact'];
  $descriptionContact= $_POST['description-contact'];
  $emailContact= $_POST['email-contact'];

  $saveMessage = "INSERT INTO messages (email, title, description) VALUES (:email_contact, :reason_contact, :description_contact)";
  $stmt = $pdo->prepare($saveMessage);
  $stmt->bindParam(':email_contact', $emailContact);
  $stmt->bindParam(':reason_contact', $reasonContact);
  $stmt->bindParam(':description_contact', $descriptionContact);
  $stmt->execute();
?>

<div id="messageSent-page">
  <h1>Votre message a bien été envoyé</h1>
  <h3 class="text-primary">Vous receverez une reponse dans les 48h, par mail.</h3>
  <a href="<?= BASE_URL ?>/">Retourner à l'accueil</a>
</div>

<?php 
  } catch(PDOException $e) { 
?>

<div id="messageSent-page">
  <h1 class="text-warning">Une erreur est survenue</h1>
  <h3 class="text-warning">Votre message n'a pas pu être envoyé. Veuillez rééssayer ulterieurement</h3>
  <a href="<?= BASE_URL ?>/">Retourner à l'accueil</a>
</div>

<?php } ?>

