<?php

class Review
{
    private $pdo; //On le garde pour futur modification (création de table dans la BDD)


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    public function getAllReviews()
    {
      return [
        [
          "name" => "Jade Jatsky", 
          "date" => "Il y a 2 mois", 
          "img" => "https://randomuser.me/api/portraits/men/3.jpg", 
          "review" => "J'ai fais confiance à Vite & Gourmand pour mon mariage. J'ai demandé s'il était possibl..."
        ],
        [
          "name" => "James Jungle", 
          "date" => "Il y a 4 mois", 
          "img" => "https://randomuser.me/api/portraits/men/3.jpg", 
          "review" => "J'ai plusieurs fois eu recours à ce traiteur pour des soirées d'entreprise, je n'ai jamais enc..."
        ],
        [
          "name" => "Jun Joussop", 
          "date" => "Il y a 1 an", 
          "img" => "https://randomuser.me/api/portraits/men/3.jpg", 
          "review" => "Très bon."
        ],
              [
          "name" => "Jun Joussop", 
          "date" => "Il y a 1 an", 
          "img" => "https://randomuser.me/api/portraits/men/3.jpg", 
          "review" => "Très bon."
        ],
        [
          "name" => "James Jungle", 
          "date" => "Il y a 4 mois", 
          "img" => "https://randomuser.me/api/portraits/men/3.jpg", 
          "review" => "J'ai plusieurs fois eu recours à ce traiteur pour des soirées d'entreprise, je n'ai jamais enc..."
        ],
        [
          "name" => "James Jungle", 
          "date" => "Il y a 4 mois", 
          "img" => "https://randomuser.me/api/portraits/men/3.jpg", 
          "review" => "J'ai plusieurs fois eu recours à ce traiteur pour des soirées d'entreprise, je n'ai jamais enc..."
        ]
      ];
    }
}