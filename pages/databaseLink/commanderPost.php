<?php

require __DIR__ . "/../../config/database.php";
$userAccount = BASE_URL . "/monCompte";

try{
  //Récupérer les données du formulaire d'inscription
  $orderDeliveryDate = $_POST['orderDeliveryDate'];
  $orderDeliveryHour = $_POST['orderDeliveryHour'];
  $orderDeliveryAddress = $_POST['orderDeliveryAddress'];
  $orderDeliveryZIP = $_POST['orderDeliveryZIP'];
  $orderDeliveryCity = $_POST['orderDeliveryCity'];
  $orderNbrPers = isset($_POST['lenorderNbrPersdStuff']);
  $lendStuff = isset($_POST['lendStuff']);
  $totalPrice = $_POST['totalPrice'];
  $menuId = $_POST['orderMenuId'];
  $userId = $_SESSION['user_id'];

  //ajouter la commande 
  $saveOrder = "
    INSERT INTO commandes (
      date_prestation, 
      heure_livraison, 
      adresse_livraison, 
      code_postal_livraison, 
      ville_livraison, 
      prix_menu, 
      nbre_pers,
      pret_materiel,
      user_id,
      menu_id
    ) 
    VALUES (
      :date_prestation, 
      :heure_livraison, 
      :adresse_livraison, 
      :code_postal_livraison, 
      :ville_livraison, 
      :prix_menu, 
      :nbre_pers, 
      :pret_materiel,
      :user_id,
      :menu_id
    )";
  $stmt = $pdo->prepare($saveOrder);
  $stmt->bindParam(':date_prestation', $orderDeliveryDate);
  $stmt->bindParam(':heure_livraison', $orderDeliveryHour);
  $stmt->bindParam(':adresse_livraison', $orderDeliveryAddress);
  $stmt->bindParam(':code_postal_livraison', $orderDeliveryZIP);
  $stmt->bindParam(':ville_livraison', $orderDeliveryCity);
  $stmt->bindParam(':prix_menu', $totalPrice);
  $stmt->bindParam(':nbre_pers', $orderNbrPers);
  $stmt->bindParam(':pret_materiel', $lendStuff);
  $stmt->bindParam(':user_id', $menuId);
  $stmt->bindParam(':menu_id', $userId);
  $stmt->execute();
  
  header("Location: $userAccount");
  exit;



}
catch (PDOException $e){
  var_dump( "Erreur de connexion à la base de données : ". $e->getMessage());
}

?>