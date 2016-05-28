<?php

function ajouter_sport($nom, $description = '') {
	global $pdo;
	$stmt = $pdo->prepare('INSERT INTO sports SET nom = :nom, description = :description');
	$stmt->bindValue('nom', $nom, PDO::PARAM_STR);
	$stmt->bindValue('description', $description, PDO::PARAM_STR);
	if($stmt->execute())
		return $pdo->lastInsertId();
	else
		return false;
}

function recuperer_sports() {

	global $pdo;
	$stmt = $pdo->query('SELECT * FROM sports');
	$resultat = array();
	while($ligne = $stmt->fetch()) {
		$resultat[] = $ligne;
	}
	return $resultat;
}

function recuperer_sport($id) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT * FROM sports WHERE id = :id');
	$stmt->bindValue('id', $id, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetch();
}