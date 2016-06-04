<?php 

if(isset($_POST['email']) && isset($_POST['mot_de_passe'])) {

	if(!empty($_POST['email']) && !empty($_POST['mot_de_passe'])) {

		if($infos_membre = connexion_membre($_POST['email'], sha1($_POST['mot_de_passe']))) {

			$_SESSION['id'] = $infos_membre['id'];
			$_SESSION['nom'] = $infos_membre['prenom'] . ' ' . $infos_membre['nom'];
			$_SESSION['role'] = $infos_membre['role'];
			$_SESSION['pseudo'] = $infos_membre['pseudo'];
			if($_SESSION['role']=='admin'){
				header('Location: ?page=bdd');
				exit();
			}else{
				$message='Vous n\'êtes pas administrateur';
			}

		} else {

			$message = "Identifiants incorrects";
		}
	} else {

		$message = "Tous les champs sont obligatoires";
	}
}
include 'vues/admin.php';
?>