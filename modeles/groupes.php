<?php

function recuperer_groupes() {

	global $mysqli;

	$requete = $mysqli->prepare('SELECT g.*, s.nom AS nom_sport FROM groupes AS g LEFT JOIN sports AS s ON s.id = g.id_sport ');
	$requete->execute();

	$donnees = $requete->get_result();
	$resultat = array();
	while($ligne = $donnees->fetch_array()) {
		$resultat[] = $ligne;
	}

	return $resultat;
}