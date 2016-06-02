<?php

include 'modeles/clubs.php';
include 'modeles/sports.php';

$sports = recuperer_sports();
$departements = recuperer_departement();

if(isset($_GET['sport']) && !empty($_GET['sport']) && isset($_GET['departement']) && !empty($_GET['departement'])){

	$clubs = recuperer_clubs_sport_departement($_GET['sport'], $_GET['departement']);

} elseif(isset($_GET['sport']) && !empty($_GET['sport'])){

	$clubs = recuperer_clubs_sport($_GET['sport']);

} elseif(isset($_GET['departement']) && !empty($_GET['departement'])) {

	$clubs = recuperer_clubs_departement($_GET['departement']);

} else {

	$clubs = recuperer_clubs();
}

if(isset($_GET['proposer'])) {

	if(isset($_POST['nom']) && isset($_POST['adresse']) && isset($_POST['departement']) && isset($_POST['code_postal']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['site']) && isset($_POST['description']) && isset($_FILES['image'])) {

		if(!empty($_POST['nom']) && isset($_POST['sports']) && !empty($_POST['sports']) && !empty($_POST['adresse']) && !empty($_POST['departement']) && !empty($_POST['code_postal']) && !empty($_FILES['image'])) {

			if($id_club = ajouter_club($_POST['nom'], $_POST['adresse'], $_POST['departement'], $_POST['code_postal'], $_POST['email'], $_POST['telephone'], $_POST['site'], $_POST['description'])) {

				foreach ($_POST['sports'] as $sport) {
					
					ajouter_sport_club($id_club, $sport);
				}

				header('Location: ?page=clubs&ajout-succes');
				exit();

			} else {

				$messages['type'] = 'erreur';
				$messages['message'] = "Impossible d'ajouter le club, merci de réessayer plus tard.";
			}

		} else {

			$messages['type'] = 'erreur';
			$messages['message'] = "Les champs marqués (*) sont obligatoires";
		}
	}

	include 'vues/clubs-proposer.php';

} else {

	if(isset($_GET['ajout-succes'])) {

		$messages['type'] = 'succes';
		$messages['message'] = "Le club a bien été enregistré ! Nous vous donnerons une réponse dès que possible.";
	}

	include 'vues/clubs.php';
}