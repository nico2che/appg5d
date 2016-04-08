<?php

function recuperer_groupes() {

	global $pdo;
	$stmt = $pdo->query('SELECT g.*, s.nom AS nom_sport FROM groupes AS g LEFT JOIN sports AS s ON s.id = g.id_sport ');
	$resultat = array();
	while($ligne = $stmt->fetch()) {
		$resultat[] = $ligne;
	}
	return $resultat;
}

function infos_groupe($id) {

	global $pdo;
	$stmt = $pdo->query('SELECT g.*, s.nom AS nom_sport FROM groupes AS g LEFT JOIN sports AS s ON s.id = g.id_sport ');
	return $stmt->fetch();
}