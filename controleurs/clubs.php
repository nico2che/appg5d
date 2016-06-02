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

			if($_FILES['image']['error'] == 0) {
				
				$taille_maximale = 4194304; // 4 Mo

				if($_FILES['image']['size'] < $taille_maximale) {

					$extensions_valides = array( 'jpg', 'jpeg', 'gif', 'png' );
					$extension = substr(strrchr($_FILES['image']['name'], '.'), 1);

					if(in_array($extension, $extensions_valides)) {

						if($id_club = ajouter_club($_POST['nom'], $_POST['adresse'], $_POST['departement'], $_POST['code_postal'], $_POST['email'], $_POST['telephone'], $_POST['site'], $_POST['description'])) {

							foreach ($_POST['sports'] as $sport) {
								
								ajouter_sport_club($sport, $id_club);
							}

							$nouveau_fichier = DOSSIER_CLUBS . $id_club . '.';

							if(move_uploaded_file($_FILES['image']['tmp_name'], $nouveau_fichier . $extension)) {

								if($extension != 'jpg') {
									switch ($extension) {
										case 'png':
											$nouveau_jpg = imagecreatefrompng($nouveau_fichier . $extension);
										    imagejpeg($nouveau_jpg, $nouveau_fichier . 'jpg', 100);
										    imagedestroy($nouveau_jpg);
										    unlink($nouveau_fichier . $extension);
											break;
										case 'gif':
											$nouveau_jpg = imagecreatefromgif($nouveau_fichier . $extension);
										    imagejpeg($nouveau_jpg, $nouveau_fichier . 'jpg', 100);
										    imagedestroy($nouveau_jpg);
										    unlink($nouveau_fichier . $extension);
											break;
										case 'jpeg':
											rename($nouveau_fichier . $extension, $nouveau_fichier . 'jpg');
											break;
										default:
											break;
									}
								}
							}

							header('Location: ?page=clubs&ajout-succes');
							exit();

						} else {

							$messages['type'] = 'erreur';
							$messages['message'] = "Impossible d'ajouter le club, merci de réessayer plus tard.";
						}

					} else {

						$messages['type'] = 'erreur';
						$messages['message'] = 'Seules les photos (jpg, jpeg, png ou gif) sont acceptées.';
					}

				} else {

					$messages['type'] = 'erreur';
					$messages['message'] = 'Le fichier ne doit pas dépasser 4 Mo';
				}

			} else {

				$messages['type'] = 'erreur';
				$messages['message'] = 'Une erreur est survenue, merci de réessayer plus tard';
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