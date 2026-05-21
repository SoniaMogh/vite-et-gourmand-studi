<?php
require __DIR__ . "/../../config/database.php";
$creationMenu = BASE_URL . "/monCompteEmploye/staffAccountAddMenu";
$menus =  BASE_URL . "/monCompteEmploye/menu";

try {

	// ------------------------ CREATION D'ENTREE --------------------------------
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addEntreebtn'])) {
		// Creation de l'entree

		$addTitreEntree = $_POST['addTitreEntree'];
		$addDescriptionEntree = $_POST['addDescriptionEntree'];

		$stmt = $pdo->prepare("
			INSERT INTO entrees (
				titre,
				description
			)
			VALUES (
				:titre,
				:description
			)
		");
		$stmt->execute([
			'titre' => $addTitreEntree,
			'description' => $addDescriptionEntree
		]);

		$entreeId = $pdo->lastInsertId();
		$allergenes = $_POST['allergenes'] ?? [];

		if ($allergenes !== []) {
			foreach ($allergenes as $allergeneId) {
				$stmt = $pdo->prepare("
						INSERT INTO entree_allergene (
							entree_id, 
							allergene_id
						)
						VALUES (
							:entree_id, 
							:allergene_id
						)
								
				");

				$stmt->execute([
						'entree_id' => $entreeId,
						'allergene_id' => $allergeneId
				]);
			}
		}
		header("Location: $creationMenu");
  	exit;
	}

	// ------------------------ CREATION DE PLAT --------------------------------
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addPlatbtn'])) {
		// Creation de l'entree

		$addTitrePlat = $_POST['addTitrePlat'];
		$addDescriptionPlat = $_POST['addDescriptionPlat'];

		$stmt = $pdo->prepare("
			INSERT INTO plats (
				titre,
				description
			)
			VALUES (
				:titre,
				:description
			)
		");
		$stmt->execute([
			'titre' => $addTitrePlat,
			'description' => $addDescriptionPlat
		]);

		$platId = $pdo->lastInsertId();
		$allergenes = $_POST['allergenes'] ?? [];

		if ($allergenes !== []) {
			foreach ($allergenes as $allergeneId) {
				$stmt = $pdo->prepare("
						INSERT INTO plat_allergene (
							plat_id, 
							allergene_id
						)
						VALUES (
							:plat_id, 
							:allergene_id
						)
								
				");

				$stmt->execute([
						'plat_id' => $platId,
						'allergene_id' => $allergeneId
				]);
			}
		}
		header("Location: $creationMenu");
  	exit;
	}

	// ------------------------ CREATION DE DESSERT --------------------------------
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addDessertbtn'])) {
		// Creation de l'entree

		$addTitreDessert = $_POST['addTitreDessert'];
		$addDescriptionDessert = $_POST['addDescriptionDessert'];

		$stmt = $pdo->prepare("
			INSERT INTO desserts (
				titre,
				description
			)
			VALUES (
				:titre,
				:description
			)
		");
		$stmt->execute([
			'titre' => $addTitreDessert,
			'description' => $addDescriptionDessert
		]);

		$dessertId = $pdo->lastInsertId();
		$allergenes = $_POST['allergenes'] ?? [];

		if ($allergenes !== []) {
			foreach ($allergenes as $allergeneId) {
				$stmt = $pdo->prepare("
						INSERT INTO dessert_allergene (
							dessert_id, 
							allergene_id
						)
						VALUES (
							:dessert_id, 
							:allergene_id
						)
								
				");

				$stmt->execute([
						'dessert_id' => $dessertId,
						'allergene_id' => $allergeneId
				]);
			}
		}
		header("Location: $creationMenu");
  	exit;
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addMenubtn'])) {
		//Fichier ou vont etre enregistre les image cote serveur
		$targetDir = __DIR__ . "/../../assets/pictures/";
		// On verfie que le dossier existe sinon on le cree
		if (!is_dir($targetDir)) {
			mkdir($targetDir, 0777, true);
		}
		// On récupere le nom de l'image cote front
		$fileName = uniqid() . "_" . $_FILES["imageMenu"]["name"];

		//On cree le nom de chemin
		$targetFile = $targetDir . $fileName;

		// On sauvegarde l'image dans le dossier
		move_uploaded_file($_FILES["imageMenu"]["tmp_name"], $targetFile);

		//Récupérer les données du formulaire de connexion
		$titreMenu = $_POST['titreMenu'];
		$descriptionMenu = $_POST['descriptionMenu'];
		$nbrePersMin = $_POST['nbrePersMin'];
		$prixPers = $_POST['prixPers'];
		$quantiteMenu = $_POST['quantiteMenu'];
		$regimeMenu = $_POST['regimeMenu'];
		$themeMenu = $_POST['themeMenu'];
		$entreeMenu = $_POST['entreeMenu'];
		$platMenu = $_POST['platMenu'];
		$dessertMenu = $_POST['dessertMenu'];

		$dbPath = "assets/pictures/" . $fileName;

		$stmt = $pdo->prepare("
				INSERT INTO menus (
					titre,
					entree_id,
					plat_id,
					dessert_id,
					nbre_pers_min,
					prix_par_pers,
					regime_id,
					theme_id,
					description,
					quantite_restante,
					img_path
				) VALUE (
					:titre,
					:entree_id,
					:plat_id,
					:dessert_id,
					:nbre_pers_min,
					:prix_par_pers,
					:regime_id,
					:theme_id,
					:description,
					:quantite_restante,
					:path
				)
						
		");

    $stmt->execute([
				'titre' => $titreMenu,
				'entree_id' => $entreeMenu,
				'plat_id' => $platMenu,
				'dessert_id' => $dessertMenu,
				'nbre_pers_min' => $nbrePersMin,
				'prix_par_pers' => $prixPers,
				'regime_id' => $regimeMenu,
				'theme_id' => $themeMenu,
				'description' => $descriptionMenu,
				'quantite_restante' => $quantiteMenu,
				'path' => $dbPath,
    ]);
		header("Location: $menus");
  	exit;
	}

} catch (PDOException $e){
	error_log($e->getMessage());
	echo "Erreur serveur";
	exit;
}