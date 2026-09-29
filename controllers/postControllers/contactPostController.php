<?php

require __DIR__ . "/../../config/database.php";
require __DIR__ . "/../../models/Message.php";


$email = $_POST['email-contact'];
$title = $_POST['reason-contact'];
$description = $_POST['description-contact'];

$messageModel = new Message($pdo);

try {

    $messageModel->createMessage(
        $email,
        $title,
        $description
    );


    require __DIR__ . "/../../views/contactMessageSent.php";


} catch(PDOException $e) {

    error_log($e->getMessage());

    require __DIR__ . "/../../views/contactMessageError.php";

}