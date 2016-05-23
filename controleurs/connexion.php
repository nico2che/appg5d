<?php

if(isset($_GET['inscrit'])) {

	$messages['type'] = 'succes';
	$messages['message'] = "Vous êtes bien inscrit !<br>Vous pouvez maintenant vous connecter";
}

if(isset($_POST['email']) && isset($_POST['mot_de_passe'])) {

	if(!empty($_POST['email']) && !empty($_POST['mot_de_passe'])) {

		if($infos_membre = connexion_membre($_POST['email'], sha1($_POST['mot_de_passe']))) {

			$_SESSION['id'] = $infos_membre['id'];
			$_SESSION['nom'] = $infos_membre['prenom'] . ' ' . $infos_membre['nom'];
			header('Location: ?page=mon-profil');
			exit();

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