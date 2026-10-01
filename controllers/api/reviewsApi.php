<?php

require __DIR__ . "/../../models/Review.php";

$reviewModel = new Review();

$reviews = $reviewModel->getAllReviews();

header('Content-Type: application/json');

echo json_encode($reviews);