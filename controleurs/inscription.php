<?php

if(isset($_POST['nom']) && isset($_POST['prenom'])  && isset($_POST['email']) && isset($_POST['mot_de_passe']) && isset($_POST['confirmation_mot_de_passe'])) {

	if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['mot_de_passe']) && !empty($_POST['confirmation_mot_de_passe'])) {

		if($_POST['mot_de_passe'] == $_POST['confirmation_mot_de_passe']) {

			if(!existe_email($_POST['email'])) {

				if($id_membre = inscrire_membre($_POST['nom'], $_POST['prenom'], $_POST['email'], sha1($_POST['mot_de_passe']))) {

					header('Location:?page=connexion&inscrit');
					exit();

				} else {

					$message = "Erreur de base de données, merci de réessayer plus tard ou de contacter un administrateur.";
				}

			} else {

				$message = "Cet email existe déjà";
			}

		} else {

			$message = "Les deux mots de passe ne correspondent pas";
		}

	} else {

		$message = "Tous les champs sont obligatoires";
	}
}

include 'vues/inscription.php';