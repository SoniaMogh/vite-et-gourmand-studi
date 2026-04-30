<?php 
require "config/config.php";
require "config/router.php"; 

$page = get_page();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="scss/main.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Vite Et Gourmand</title>
  </head>
  <body>
    <header>
    </header>
  <main>
    <?php require $page; ?>
  </main>
  <footer></footer>
    <script type="module" src="./Router/router.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>



