<?php
  
  session_destroy();
  $login = BASE_URL . "/connexion";

  header("Location: $login");
  exit;