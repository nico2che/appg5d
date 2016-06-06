<?php

if(!connecte()) {
	header('Location: ./');
	exit();
}

include 'modeles/clubs.php';

if(isset($_GET['upload'])) {

	$json = array('statut' => 1);

	if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0) {
		
		$taille_maximale = 4194304; // 4 Mo

		if($_FILES['photo']['size'] < $taille_maximale) {
			
			$extensions_valides = array( 'jpg', 'jpeg', 'gif', 'png' );
			$extension = substr(strrchr($_FILES['photo']['name'], '.'), 1);

			if(in_array($extension, $extensions_valides)) {

				$nouveau_fichier = DOSSIER_AVATAR . $_SESSION['id'] . '.';

				if(move_uploaded_file($_FILES['photo']['tmp_name'], $nouveau_fichier . $extension)) {

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

					$json['statut'] = 0;
					$json['message'] = 'La photo a bien été modifiée.';

				} else {

					$json['message'] = 'Une erreur est survenue, merci de réessayer plus tard';
				}

			} else {

				$json['message'] = 'Seules les photos (jpg, jpeg, png ou gif) sont acceptées.';
			}

		} else {

			$json['message'] = 'Le fichier ne doit pas dépasser 4 Mo';
		}

	} else {

		$json['message'] = 'Une erreur est survenue, merci de réessayer plus tard';
	}

	echo json_encode($json);
	exit();
}

$messages = array('informations' => array(), 'mot_de_passe' => array());

if(isset($_POST['pseudo']) && isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['email'])) {

	if(!empty($_POST['pseudo']) && !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['email'])) {

		if(preg_match('#^[a-zA-Z0-9._-]+\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$#', $_POST['email'])) {

			$informations = profil_membre($_SESSION['id']);

			if($informations['email'] == $_POST['email'] || !existe_email($_POST['email'])) {
			
				if($informations['pseudo'] == $_POST['pseudo'] || !existe_pseudo($_POST['pseudo'])) {

					if(modifier_membre($_SESSION['id'], $_POST['pseudo'], $_POST['nom'], $_POST['prenom'], $_POST['email'], (isset($_POST['sexe']) ? $_POST['sexe'] : null), (isset($_POST['description']) ? $_POST['description'] : null), (isset($_POST['departement']) ? $_POST['departement'] : null))) {

						$messages['informations']['type'] = 'succes';
						$messages['informations']['message'] = 'Les informations ont été modifiées avec succès.';

					} else {

						$messages['informations']['type'] = 'erreur';
						$messages['informations']['message'] = 'Une erreur est survenue, merci de réessayer plus tard.';
					}

				} else {

					$messages['informations']['type'] = 'erreur';
					$messages['informations']['message'] = 'Ce pseudo est déjà utilisé par un autre membre, merci d\'en choisir un autre.';
				}

			} else {

				$messages['informations']['type'] = 'erreur';
					$messages['informations']['message'] = 'Cet email est déjà utilisé par un autre membre, merci d\'en choisir un autre.';
			}

		} else {

			$messages['informations']['type'] = 'erreur';
			$messages['informations']['message'] = "L'email n'est pas valide.";
		}

	} else {

		$messages['informations']['type'] = 'erreur';
		$messages['informations']['message'] = 'Tous les champs sont obligatoires pour modifier ces informations.';
	}
}

if(isset($_POST['mot_de_passe_actuel']) && isset($_POST['mot_de_passe']) && isset($_POST['confirmation_mot_de_passe'])) {

	if(!empty($_POST['mot_de_passe_actuel']) && !empty($_POST['mot_de_passe']) && !empty($_POST['confirmation_mot_de_passe'])) {
		
		if(verifier_membre($_SESSION['id'], sha1($_POST['mot_de_passe_actuel']))) {

			if(strlen($_POST['mot_de_passe']) > 7) {

				if(preg_match('#(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).+#', $_POST['mot_de_passe'])) {

					if($_POST['mot_de_passe'] == $_POST['confirmation_mot_de_passe']) {

						if(modifier_mot_de_passe($_SESSION['id'], sha1($_POST['mot_de_passe']))) {

							$messages['mot_de_passe']['type'] = 'succes';
							$messages['mot_de_passe']['message'] = 'Le mot de passe a été modifié avec succès.';

						} else {

							$messages['mot_de_passe']['type'] = 'erreur';
							$messages['mot_de_passe']['message'] = 'Une erreur est survenue, merci de réessayer plus tard.';
						}

					} else {

						$messages['mot_de_passe']['type'] = 'erreur';
						$messages['mot_de_passe']['message'] = "Les deux mots de passe ne correspondent pas";
					}

				} else {

					$messages['mot_de_passe']['type'] = 'erreur';
					$messages['mot_de_passe']['message'] = "Le nouveau mot de passe doit être au moins composé d'une minuscule, d'une majuscule et d'un chiffre.";
				}

			} else {

				$messages['mot_de_passe']['type'] = 'erreur';
				$messages['mot_de_passe']['message'] = "Le mot de passe doit être de 8 caractères minimum.";
			}

		} else {

			$messages['mot_de_passe']['type'] = 'erreur';
			$messages['mot_de_passe']['message'] = "Mot de passe actuel erroné.";
		}

	} else {

		$messages['mot_de_passe']['type'] = 'erreur';
		$messages['mot_de_passe']['message'] = 'Tous les champs sont obligatoires pour modifier le mot_de_passe.';
	}
}

$informations = profil_membre($_SESSION['id']);
$departements = recuperer_departement();

include 'vues/mon-profil.php';