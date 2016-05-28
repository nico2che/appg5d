<?php

include 'modeles/sports.php';
include 'modeles/forum.php';

$sports = recuperer_sports();

if(isset($_GET['ajouter'])) {

	if(isset($_POST['titre']) && isset($_POST['contenu'])) {

		if(!empty($_POST['titre']) && !empty($_POST['contenu'])) {

			if($id_sujet = ajouter_sujet($_POST['titre'], $_POST['contenu'], (isset($_GET['sport']) ? $_GET['sport'] : 0))) {

				header('Location: ?page=forum&sujet='.$id_sujet);
				exit();
				
			} else {

				$message = 'Impossible de créer le sujet, merci de réessayer plus tard';
			}

		} else {

			$message = 'Tous les champs sont obligatoires';
		}
	}

	include 'vues/forum-ajouter.php';

} elseif(isset($_GET['sujet'])) {

	$id_sujet = (int) $_GET['sujet'];

	$sujet = recuperer_sujet($id_sujet);

	if(isset($_POST['message'])) {

		if(!empty($_POST['message'])) {

			if(ajouter_message($_POST['message'], $id_sujet)) {

				$message = 'Le message a bien été posté !';

			} else {

				$message = 'Impossible de rajouter ce message, veuillez réessayer plus tard';
			}

		} else {

			$message = 'Tous les champs sont obligatoires';
		}
	}

	$messages = recuperer_messages($_GET['sujet']);
	include 'vues/forum-sujet.php';

} elseif(isset($_GET['sport'])) {

	$id_sport = (int) $_GET['sport'];
	$sujets_sport = recuperer_sujets_sport($id_sport);
	$sport = recuperer_sport($id_sport);
	include 'vues/forum-sports.php';

} else {

	$sujets_aide = recuperer_sujets_sport(0);
	include 'vues/forum.php';
}