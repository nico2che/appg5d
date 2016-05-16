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

include 'vues/club.php';