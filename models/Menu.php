<?php

class Menu
{
    private $pdo; // Connexion à la base de donnée


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllMenuInfos() {
      //Récupérer les menus 
      $query = "
        SELECT
          menus.*,

            entrees.titre AS entree_titre,
            entrees.description AS entree_description,

            plats.titre AS plat_titre,
            plats.description AS plat_description,

            desserts.titre AS dessert_titre,
            desserts.description AS dessert_description
          
        FROM
          menus
        JOIN entrees ON menus.entree_id = entrees.id
        JOIN plats ON menus.plat_id = plats.id
        JOIN desserts ON menus.dessert_id = desserts.id
      ";
      $stmt = $this->pdo->prepare($query);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEntreeAllergenes($id) {
        $stmt = $this->pdo->prepare(
              "SELECT allergenes.libelle
              FROM entree_allergene
              JOIN allergenes ON allergenes.id = entree_allergene.allergene_id
              WHERE entree_allergene.entree_id = :id"
        );

        $stmt->execute([
          'id' => $id
        ]);

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getPlatAllergenes($id) {
        $stmt = $this->pdo->prepare("
          SELECT allergenes.libelle
          FROM plat_allergene
          JOIN allergenes ON allergenes.id = plat_allergene.allergene_id
          WHERE plat_allergene.plat_id = :id
        ");

        $stmt->execute([
          'id' => $id
        ]);

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getDessertAllergenes($id) {
        $stmt = $this->pdo->prepare("
          SELECT allergenes.libelle
          FROM dessert_allergene
          JOIN allergenes ON allergenes.id = dessert_allergene.allergene_id
          WHERE dessert_allergene.dessert_id = :id
        ");

        $stmt->execute([
          'id' => $id
        ]);

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}