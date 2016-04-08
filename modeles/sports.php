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