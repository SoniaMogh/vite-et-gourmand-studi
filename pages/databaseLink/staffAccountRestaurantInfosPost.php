<?php
require __DIR__ . "/../../config/database.php";
$infoPage = BASE_URL . "/monCompteEmploye/InfosRestaurant";

try{
  //Récupérer les horaires
  $query = "SELECT * FROM horaires";
  $stmt = $pdo->prepare($query);
  $stmt->execute();

  $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $horaires = array_column($datas, null, 'id');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $weekdayMorningTimeOpening = $_POST['weekdayMorningTimeOpening'];
    $weekdayMorningTimeClosing = $_POST['weekdayMorningTimeClosing'];
    $weekdayNightTimeOpening = $_POST['weekdayNightTimeOpening'];
    $weekdayNightTimeClosing = $_POST['weekdayNightTimeClosing'];

    $sundayMorningTimeOpening = $_POST['sundayMorningTimeOpening'];
    $sundayMorningTimeClosing = $_POST['sundayMorningTimeClosing'];
    $sundayNightTimeOpening = $_POST['sundayNightTimeOpening'];
    $sundayNightTimeClosing = $_POST['sundayNightTimeClosing'];

    $queryUpdateMorning = "
      UPDATE 
        horaires
      SET 
        morning_opening = :morning_opening,
        morning_closing = :morning_closing,
        night_opening = :night_opening,
        night_closing = :night_closing
      WHERE 
        id = 1
    ";

    $stmt2 = $pdo->prepare($queryUpdateMorning);
    $stmt2->execute([
      ':morning_opening' => $weekdayMorningTimeOpening,
      ':morning_closing' => $weekdayMorningTimeClosing,
      ':night_opening' => $weekdayNightTimeOpening,
      ':night_closing' => $weekdayNightTimeClosing
    ]);


    $queryUpdateNight = "
      UPDATE 
        horaires
      SET 
        morning_opening = :morning_opening,
        morning_closing = :morning_closing,
        night_opening = :night_opening,
        night_closing = :night_closing
      WHERE 
        id = 2
    ";

    
    $stmt3 = $pdo->prepare($queryUpdateNight);
    $stmt3->execute([
      ':morning_opening' => $sundayMorningTimeOpening,
      ':morning_closing' => $sundayMorningTimeClosing,
      ':night_opening' => $sundayNightTimeOpening,
      ':night_closing' => $sundayNightTimeClosing
    ]);
    header("Location: $infoPage?success=saved");
    exit;
  }



}
catch (PDOException $e){
    echo "Erreur de connexion à la base de données : ". $e->getMessage();
}

?>