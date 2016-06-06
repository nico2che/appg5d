<?php

include 'modeles/sports.php';
include 'modeles/forum.php';
include 'modeles/pagination.php';

// On récupère la liste des sports
$sports = recuperer_sports();
$messages = array();

if(isset($_GET['ajouter'])) { // Si on veut ajouter un sujet

	// SI on a envoyé le formulaire
	if(isset($_POST['titre']) && isset($_POST['contenu'])) {

		// Si tous les champs sont renseignés
		if(!empty($_POST['titre']) && !empty($_POST['contenu'])) {

			// Si on est connecté
			if(connecte()) {

				// Alors on ajoute le sujet
				if($id_sujet = ajouter_sujet($_POST['titre'], $_POST['contenu'], (isset($_GET['sport']) ? $_GET['sport'] : 0))) {

					// Et on redirige dessus
					header('Location: ?page=forum&sujet='.$id_sujet);
					exit();
					
				} else {

					$messages['type'] = 'erreur';
					$messages['message'] = 'Impossible de créer le sujet, merci de réessayer plus tard';
				}

			} else {

				$messages['type'] = 'erreur';
				$messages['message'] = 'Vous devez être connecté';
			}

		} else {

			$messages['type'] = 'erreur';
			$messages['message'] = 'Tous les champs sont obligatoires';
		}
	}

	// On inclue la vue formulaire
	include 'vues/forum-formulaire.php';

} elseif(isset($_GET['modifier']) && isset($_GET['sujet']) && !empty($_GET['sujet'])) { // Si on modifie

	// On récupère le sujet
	$id_sujet = (int) $_GET['sujet'];

	// Si on a envoyé le formulaire
	if(isset($_POST['titre']) && isset($_POST['contenu'])) {

		// Et que tous les champs sont renseignés
		if(!empty($_POST['titre']) && !empty($_POST['contenu'])) {

			// Alors on modifie le sujet
			if(modifier_sujet($id_sujet, $_POST['titre'], $_POST['contenu'])) {

				$messages['type'] = 'succes';
				$messages['message'] = 'Le sujet a bien été modifié ! <a href="?page=forum&sujet='.$id_sujet.'">Retourner au sujet</a>';
				
			} else {

				$messages['type'] = 'erreur';
				$messages['message'] = 'Impossible de modifier le sujet, merci de réessayer plus tard';
			}

		} else {

			$messages['type'] = 'erreur';
			$messages['message'] = 'Tous les champs sont obligatoires';
		}
	}

	// On charge les informations de ce sujet
	$sujet = recuperer_sujet($id_sujet);

	// On inclue la vue formulaire
	include 'vues/forum-formulaire.php';

} elseif(isset($_GET['sujet'])) { // Si on lit un sujet

	// On récupère le sujet
	$id_sujet = (int) $_GET['sujet'];
	$sujet = recuperer_sujet($id_sujet);

	// Si on veut ajouter un message
	if(isset($_POST['message'])) {

		// On doit être connecté
		if(connecte()) {

			// Le message doit être explicite
			if(!empty($_POST['message'])) {

				// On l'ajoute
				if(ajouter_message($_POST['message'], $id_sujet)) {

					$messages['type'] = 'succes';
					$messages['message'] = 'Le message a bien été posté !';

				} else {

					$messages['type'] = 'erreur';
					$messages['message'] = 'Impossible de rajouter ce message, veuillez réessayer plus tard';
				}

			} else {

				$messages['type'] = 'erreur';
				$messages['message'] = 'Tous les champs sont obligatoires';
			}

		} else {

			$messages['type'] = 'erreur';
			$messages['message'] = 'Vous devez être connecté pour répondre à un sujet';
		}
	}

	// Si on veut supprimer un message
	if(isset($_GET['supprimer-message'])) {

		// On doit être connecté
		if(connecte()) {
			
			if(csrf($_GET)) {

				// Le message doit être explicite
				if(!empty($_GET['supprimer-message'])) {

					$id_message = (int) $_GET['supprimer-message'];

					// On vérifie que ce message appartient bien à la connexion actuelle
					if(message_auteur($_SESSION['id'], $id_message)) {

						// On peut supprimer
						if(supprimer_message($id_message)) {

							header('Location: ?page=forum&sujet='.$id_sujet.'&supprimer-succes');
							exit();

						} else {

							$messages['type'] = 'erreur';
							$messages['message'] = 'Impossible de supprimer ce message, veuillez réessayer plus tard';
						}
					} else {

						$messages['type'] = 'erreur';
						$messages['message'] = 'Vous n\'êtes pas l\'auteur de ce message !';
					}
				}

			} else {

				$messages['type'] = 'erreur';
				$messages['message'] = 'Impossible de traiter la requête (Erreur CSRF)';
			}
		}
	}

	// Si on veut supprimer le sujet
	if(isset($_GET['supprimer'])) {

		// On doit être connecté
		if(connecte()) {
			
			if(csrf($_GET)) {

				// On vérifie que ce sujet appartient bien à la connexion actuelle
				if(sujet_auteur($_SESSION['id'], $id_sujet)) {

					// On peut supprimer
					if(supprimer_sujet($id_sujet)) {

						header('Location: ?page=forum&supprimer-succes');
						exit();

					} else {

						$messages['type'] = 'erreur';
						$messages['message'] = 'Impossible de supprimer ce sujet, veuillez réessayer plus tard';
					}
					
				} else {

					$messages['type'] = 'erreur';
					$messages['message'] = 'Vous n\'êtes pas l\'auteur de ce sujet !';
				}
				
			} else {

				$messages['type'] = 'erreur';
				$messages['message'] = 'Impossible de traiter la requête (Erreur CSRF)';
			}
		}
	}

	if(isset($_GET['supprimer-succes'])) {

		$messages['type'] = 'succes';
		$messages['message'] = 'Le message a bien été supprimé !';
	}

	$messages_sujet = recuperer_messages($id_sujet);
	include 'vues/forum-sujet.php';

} elseif(isset($_GET['sport'])) { // Si on liste les sujets d'un sport

	$sujets_par_page = 10;
	if(isset($_GET['p']) && !empty($_GET['p'])) {
		$page = (int) $_GET['p'];
	} else {
		$page = 1;
	}
	$debut_requete = ($page - 1) * $sujets_par_page;
	
	// On récupère le sport
	$id_sport = (int) $_GET['sport'];

	// On récupère les sujets de ce sport
	$recherche = recuperer_sujets_sport($id_sport, $debut_requete, $sujets_par_page);
	$sujets_sport = $recherche['lignes'];
	$total_sujets = $recherche['nombre'];

	// ON récupère les informations de ce sport
	$sport = recuperer_sport($id_sport);

	// On inclue la vue
	include 'vues/forum-sports.php';

} else {

	$sujets_par_page = 5;
	if(isset($_GET['p']) && !empty($_GET['p'])) {
		$page = (int) $_GET['p'];
	} else {
		$page = 1;
	}
	$debut_requete = ($page - 1) * $sujets_par_page;

	if(isset($_GET['supprimer-succes'])) {

		$messages['type'] = 'succes';
		$messages['message'] = 'Le sujet a bien été supprimé !';
	}

	// On récupère les sujets d'aide (sport = 0)
	$recherche = recuperer_sujets_sport(0, $debut_requete, $sujets_par_page);
	$sujets_aide = $recherche['lignes'];
	$total_sujets = $recherche['nombre'];

	// On inclue la vue principale du forum
	include 'vues/forum.php';
}