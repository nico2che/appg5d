<?php

function recuperer_groupes() {

	global $pdo;
	$stmt = $pdo->query('SELECT s.nom AS nom_sport, g.* FROM groupes AS g
															JOIN sports AS s ON s.id = g.id_sport');
	while($ligne = $stmt->fetch()) {
		$resultat[] = $ligne;
	}
	return $resultat;
}

function ajouter_date($id_groupe, $date, $localisation, $duree) {

	global $pdo;
	$stmt = $pdo->prepare('INSERT INTO dates_rencontres SET id_groupe = :id_groupe,
															date = :date,
															localisation = :localisation,
															duree = :duree');
	$stmt->bindValue('id_groupe', $id_groupe, PDO::PARAM_INT);
	$stmt->bindValue('date', $date, PDO::PARAM_STR);
	$stmt->bindValue('localisation', $localisation, PDO::PARAM_STR);
	$stmt->bindValue('duree', $duree, PDO::PARAM_STR);
	if($stmt->execute())
		return $pdo->lastInsertId();
	else
		return false;
}

function infos_groupe($id) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT s.nom AS nom_sport, g.* 	FROM groupes_membres AS g_m
																JOIN groupes AS g ON g.id = g_m.id_groupe
																JOIN membres AS m ON m.id = g_m.id_membre
																JOIN sports AS s ON s.id = g.id_sport
															WHERE g.id = :id');
	$stmt->bindValue('id', $id, PDO::PARAM_INT);
	$stmt->execute();
	return $ligne = $stmt->fetch();
}

function membres_groupe($id) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT g_m.type AS type, m.* FROM groupes_membres AS g_m
															JOIN groupes AS g ON g.id = g_m.id_groupe
															JOIN membres AS m ON m.id = g_m.id_membre
														WHERE g.id = :id');
	$stmt->bindValue('id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$resultat = array();
	while($ligne = $stmt->fetch()) {
		$resultat[$ligne['type']] = $ligne;
	}
	return $resultat;
}

function dates_groupe($id) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT d.* 	FROM groupes AS g
											JOIN dates_rencontres AS d ON d.id_groupe = g.id
										WHERE g.id = :id');
	$stmt->bindValue('id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$resultat = array();
	while($ligne = $stmt->fetch()) {
		$resultat[] = $ligne;
	}
	return $resultat;
}