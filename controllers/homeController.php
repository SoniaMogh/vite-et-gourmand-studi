<?php

require __DIR__ . "/../config/database.php";
require __DIR__ . "/../models/Review.php";


$reviewModel = new Review($pdo);


$reviews = $reviewModel->getAllReviews();


require __DIR__ . "/../views/home.php";