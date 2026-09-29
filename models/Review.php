<?php

use MongoDB\Client;

class Review
{
    private $pdo; //On le garde pour futur modification (création de table dans la BDD)
    private $collection;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;

        // Connexion à MongoDB Atlas 
        $client = new Client(getenv('MONGODB_URI'));
        
        // Base de données MongoDB 
        $db = $client->selectDatabase('vite_et_gourmand'); 

        // Collection qui contiendra les avis 
        $this->collection = $db->selectCollection('reviews');
    }

    public function addReview($name, $img, $review) 
    { 
      return $this->collection->insertOne([ 
        'name' => $name, 
        'img' => $img, 
        'review' => $review, 
        'date' => new MongoDB\BSON\UTCDateTime() 
      ]); 
    }


    public function getAllReviews()
    {
      $reviews = $this->collection->find();

      $result = [];

      foreach ($reviews as $review) {
          $result[] = [
              "name" => $review["name"],
              "date" => $review["date"],
              "img" => $review["img"],
              "review" => $review["review"]
          ];
      }

      return $result;
    }
}