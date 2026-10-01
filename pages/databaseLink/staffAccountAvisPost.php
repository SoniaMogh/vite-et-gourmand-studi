<?php

use MongoDB\Client;
use MongoDB\BSON\ObjectId;

require __DIR__ . "/../../vendor/autoload.php";

$reviewsPage = BASE_URL . "/monCompteEmploye/staffAccountAvis";

try {

    // Connexion à MongoDB
    $client = new Client(getenv('MONGODB_URI'));

    $db = $client->selectDatabase('vite_et_gourmand');
    $collection = $db->selectCollection('reviews');


    // Si on valide un avis
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accepteReview'])) {

        $reviewToUpdate = new ObjectId($_POST['reviewToUpdate']);

        $collection->updateOne(
            ['_id' => $reviewToUpdate],
            ['$set' => ['status' => '1']]
        );

        header("Location: $reviewsPage");
        exit;
    }


    // Si on retire un avis
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hideReview'])) {

        $reviewToUpdate = new ObjectId($_POST['reviewToUpdate']);

        $collection->updateOne(
            ['_id' => $reviewToUpdate],
            ['$set' => ['status' => '0']]
        );

        header("Location: $reviewsPage");
        exit;
    }


    // Récupération de tous les avis
    $reviews = $collection->find();

    $tousAvis = [];

    foreach ($reviews as $avis) {

        $tousAvis[] = [
          'id' => (string) $avis['_id'],
          'name' => $avis['name'],
          'date' => $avis['date'],
          'review' => $avis['review'],
          'stars' => (int) $avis['stars'],
          'status' => (int) $avis['status']
        ];
    }


} catch (Exception $e) {

    error_log($e->getMessage());
    echo "Erreur serveur";
    exit;
}