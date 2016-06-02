<?php

include 'modeles/clubs.php';

function moyenne($commentaires){
	$moyenne=0;
	$nombre_commentaires = count($commentaires);
	if($nombre_commentaires == 0)
		return 0;
	foreach($commentaires as $commentaire) {
		$moyenne += $commentaire['note'];
	}
	return round($moyenne / count($commentaires), 1);
}

if(isset($_GET['id']) && !empty($_GET['id'])) {

	$id_club = (int) $_GET['id'];

	$informations = recuperer_club($id_club);

	if(!empty($informations)) {

		$club = $informations['club'];
		$commentaires = $informations['commentaires'];
		$sports = $informations['sports'];

		if(connecte() && isset($_POST['commentaire']) && !empty($_POST['commentaire'])) {

			if(dejaCommente($_SESSION['id'],$_GET['id'])==false){

				if(ajouterCommentaire($id_club, $_SESSION['id'], $_POST['commentaire'], $_POST['note'])) {

					$messages['type'] = 'succes';
					$messages['message'] = 'Le commentaire a été ajouté avec succès';
				} else {

					$messages['type'] = 'erreur';
					$messages['message'] = 'Impossible d\'ajouter le commentaire, veuillez réessayer plus tard';
				}

			} else {

				if(modifierCommentaire($id_club, $_SESSION['id'], $_POST['commentaire'], $_POST['note'])) {

					$messages['type'] = 'succes';
					$messages['message'] = 'Le commentaire a été modifié avec succès';

				} else {

					$messages['type'] = 'erreur';
					$messages['message'] = 'Impossible de modifier le commentaire, veuillez réessayer plus tard';
				}
			}

			$informations = recuperer_club($id_club);
			$commentaires = $informations['commentaires'];
		}
	}

	include 'vues/club.php';
}