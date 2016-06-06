<?php

if(isset($_GET['inscrit'])) {

	$messages['type'] = 'succes';
	$messages['message'] = "Vous êtes bien inscrit !<br>Vous pouvez maintenant vous connecter";
}


if(isset($_POST['email']) && isset($_POST['mot_de_passe'])) {

	if(!empty($_POST['email']) && !empty($_POST['mot_de_passe'])) {

		if($infos_membre = connexion_membre($_POST['email'], sha1($_POST['mot_de_passe']))) {

			if($infos_membre['bannis'] == 0) {

				$_SESSION['id'] = $infos_membre['id'];
				$_SESSION['nom'] = $infos_membre['prenom'] . ' ' . $infos_membre['nom'];
				$_SESSION['pseudo'] = $infos_membre['pseudo'];

				if(isset($_POST['souvenir']) && !empty($_POST['souvenir'])) {

					setcookie('membre', $infos_membre['id'], (time() + 24 * 30));
					setcookie('hash', sha1($_POST['mot_de_passe']), (time() + 24 * 30));
				}

				header('Location: ?page=profil');
				exit();

			} else {

				$messages['type'] = 'erreur';
				$messages['message'] = "Connexion interdite, le compte a été désactivé";
			}

		} else {

			$messages['type'] = 'erreur';
			$messages['message'] = "Identifiants incorrects";
		}

	} else {

		$messages['type'] = 'erreur';
		$messages['message'] = "Tous les champs sont obligatoires";
	}
}

include 'vues/connexion.php';