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
    <title>Vite Et Gourmand</title>
  </head>
  <body>
    <header>
    </header>
  <main>
    <?php require $page; ?>
  </main>
  <footer></footer>
  </body>
</html>



