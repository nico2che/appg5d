<?php

include 'modeles/sports.php';
include 'modeles/forum.php';

$sports = recuperer_sports();

if(isset($_GET['ajouter'])) {

	if(isset($_POST['titre']) && isset($_POST['contenu'])) {

		if(!empty($_POST['titre']) && !empty($_POST['contenu'])) {

			if(ajouter_sujet_aide($_POST['titre'], $_POST['contenu'])) {

				header('Location:?page=forum');
				exit();
				
			} else {


			}

		} else {

			$message = 'Tous les champs sont obligatoires';
		}
	}

	include 'vues/forum-ajouter.php';

} else {

	include 'vues/forum.php';
}