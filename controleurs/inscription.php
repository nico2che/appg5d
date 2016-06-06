<?php

include 'modeles/clubs.php';

if(isset($_POST['pseudo']) && isset($_POST['nom']) && isset($_POST['prenom'])  && isset($_POST['email']) && isset($_POST['mot_de_passe']) && isset($_POST['confirmation_mot_de_passe'])) {

	if(!empty($_POST['nom']) && !empty($_POST['pseudo']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['mot_de_passe']) && !empty($_POST['confirmation_mot_de_passe'])) {

		if(strlen($_POST['mot_de_passe']) > 7) {

			if(preg_match('#(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).+#', $_POST['mot_de_passe'])) {

				if(preg_match('#^[a-zA-Z0-9._-]+\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$#', $_POST['email'])) {

					if($_POST['mot_de_passe'] == $_POST['confirmation_mot_de_passe']) {

						if(!existe_email($_POST['email'])) {

							if($id_membre = inscrire_membre($_POST['pseudo'], $_POST['nom'], $_POST['prenom'], $_POST['email'], sha1($_POST['mot_de_passe']), (isset($_POST['sexe']) ? $_POST['sexe'] : null), (isset($_POST['departement']) ? $_POST['departement'] : null))) {

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

					$message = "L'email n'est pas valide.";
				}

			} else {

				$message = "Le mot de passe doit être au moins composé d'une minuscule, d'une majuscule et d'un chiffre.";
			}

		} else {

			$message = "Le mot de passe doit être de 8 caractères minimum.";
		}

	} else {

		$message = "Les champs marqués (*) sont obligatoires.";
	}
}

$departements = recuperer_departement();

include 'vues/inscription.php';