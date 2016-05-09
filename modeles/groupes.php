<?php

function recuperer_groupes() {

	global $pdo;
	$stmt = $pdo->query('SELECT s.nom AS nom_sport, g.* FROM groupes AS g
															LEFT JOIN sports AS s ON s.id = g.id_sport');
	while($ligne = $stmt->fetch()) {
		$resultat[] = $ligne;
	}
	return $resultat;
}

function infos_groupe($id) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT s.nom AS nom_sport, g.*	FROM groupes_membres AS g_m
																LEFT JOIN groupes AS g ON g.id = g_m.id_groupe
																LEFT JOIN membres AS m ON m.id = g_m.id_membre
																LEFT JOIN sports AS s ON s.id = g.id_sport
															WHERE g.id = :id');
	$stmt->bindValue('id', $id, PDO::PARAM_INT);
	$stmt->execute();
	return $ligne = $stmt->fetch();
}

function membres_groupe($id) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT g_m.type AS type, m.* FROM groupes_membres AS g_m
															LEFT JOIN groupes AS g ON g.id = g_m.id_groupe
															LEFT JOIN membres AS m ON m.id = g_m.id_membre
														WHERE g.id = :id');
	$stmt->bindValue('id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$resultat = array();
	while($ligne = $stmt->fetch()) {
		$resultat[$ligne['type']] = $ligne;
	}
	return $resultat;
}