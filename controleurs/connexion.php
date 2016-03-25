<?php

$fichier_css='connexion.css';

if(isset($_GET['inscrit'])) {

	$message = "Vous êtes bien inscrit !<br>Vous pouvez maintenant vous connecter";
}

if(isset($_POST['email']) && isset($_POST['mot_de_passe'])) {

	if(!empty($_POST['email']) && !empty($_POST['mot_de_passe'])) {

		if($infos_membre = connexion_membre($_POST['email'], sha1($_POST['mot_de_passe']))) {

			$_SESSION['id'] = $infos_membre['id'];
			$_SESSION['nom'] = $infos_membre['prenom'] . ' ' . $infos_membre['nom'];
			header('Location: ?page=mon-profil');
			exit();

		} else {

			$message = "Identifiants incorrects";
		}
	} else {

		$message = "Tous les champs sont obligatoires";
	}
}

include 'vues/connexion.php';