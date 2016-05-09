<?php

function ajouter_sujet_aide($titre, $contenu) {

	global $pdo;
	$stmt = $pdo->prepare('INSERT INTO forum_sujets SET 	titre = :titre,
															message = :contenu,
															resolu = 0,
															date = NOW(),
															id_sport = 0,
															id_membre = :id_membre');
	$stmt->bindValue('titre', $titre, PDO::PARAM_STR);
	$stmt->bindValue('contenu', $contenu, PDO::PARAM_STR);
	$stmt->bindValue('id_membre', $_SESSION['id'], PDO::PARAM_INT);
	if($stmt->execute())
		return $pdo->lastInsertId();
	else
		return false;
}