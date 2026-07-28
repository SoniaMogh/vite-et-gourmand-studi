<?php

class Message
{
    private PDO $pdo;


    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function createMessage($email, $title, $description)
    {
        $query = "
            INSERT INTO messages (email, titre, description)
            VALUES (:email, :title, :description)
        ";

        $stmt = $this->pdo->prepare($query);

        $stmt->execute([
            "email" => $email,
            "title" => $title,
            "description" => $description
        ]);
    }
}