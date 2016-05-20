<?php

include 'modeles/clubs.php';

$recup_club=info_club((int) $_GET['id']);

function sportParId($listIds){

	$resultat = array();
	foreach ($listIds as $listId) {
		$resultat[] = sport_id($listId[1]);
		 
	}
	return $resultat;
}




function nomPrenom($id){
	return idM_nomM($id);
}

function moyenne($commentaires){
	$moyenne=0;
	$nombre=0;
	foreach ($commentaires as $recup_commentaire) {
			$moyenne=$moyenne+$recup_commentaire[4];
			$nombre=1+$nombre;
		}
	
	if ($nombre==0){
		return "-";
	}
	else {
		return $moyenne/$nombre;
	}
	
}

if (isset($_POST['conntenuMessageComment']) && (!empty($_POST['conntenuMessageComment']) )){
	$idC=$recup_club['id'];
	$idM=$_SESSION['id'];
	$comment=$_POST['conntenuMessageComment'];
	$note=$_POST['note'];
	if (DejaCommenter($_SESSION['id'])==false){
		ajouterCommentaire($idC,$idM,$comment,$note);
	}
	else {
		modifierComment($comment,$note,$idM);
	}
	
}
	
$recup_commentaires=commentaire((int) $_GET['id']);





include 'vues/club.php';