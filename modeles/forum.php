<?php

function ajouter_sujet($titre, $contenu, $sport) {

	global $pdo;
	$stmt = $pdo->prepare('INSERT INTO forum_sujets SET 	titre = :titre,
															message = :contenu,
															resolu = 0,
															date = NOW(),
															id_sport = :sport,
															id_membre = :id_membre');
	$stmt->bindValue('titre', $titre, PDO::PARAM_STR);
	$stmt->bindValue('contenu', $contenu, PDO::PARAM_STR);
	$stmt->bindValue('sport', $sport, PDO::PARAM_INT);
	$stmt->bindValue('id_membre', $_SESSION['id'], PDO::PARAM_INT);
	if($stmt->execute())
		return $pdo->lastInsertId();
	else
		return false;
}
function recuperer_sujets_aide() {

	global $pdo;
	return $pdo->query('SELECT * FROM forum_sujets WHERE id_sport = 0');
}
function recuperer_sujet($id) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT f.id id_sujet, f.*, m.id id_membre, m.* FROM forum_sujets AS f
																				JOIN membres AS m ON f.id_membre = m.id
																			WHERE f.id = :id');
	$stmt->bindValue('id', $id, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetch();
}
function recuperer_sujets_sport($id_sport) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT f.id id_sujet, f.*, m.id id_membre, m.* FROM forum_sujets AS f
																				JOIN membres AS m ON f.id_membre = m.id
																			WHERE id_sport = :id_sport');
	$stmt->bindValue('id_sport', $id_sport, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll();
}
function modifier_sujet($id, $nom, $message) {

	global $pdo;
	$stmt = $pdo->prepare('UPDATE forum_sujets SET nom = :nom,
													messages = :message
												WHERE id = :id');
	$stmt->bindValue('id', $id, PDO::PARAM_INT);
	$stmt->bindValue('nom', $nom, PDO::PARAM_STR);
	$stmt->bindValue('message', $message, PDO::PARAM_STR);
	return $stmt->execute();
}
function ajouter_message($message, $id_sujet) {

	global $pdo;
	$stmt = $pdo->prepare('INSERT INTO forum_messages SET message = :message,
														id_membre = :id_membre,
														id_sujet = :id_sujet,
														date = NOW()');
	$stmt->bindValue('message', $message, PDO::PARAM_STR);
	$stmt->bindValue('id_membre', $_SESSION['id'], PDO::PARAM_INT);
	$stmt->bindValue('id_sujet', $id_sujet, PDO::PARAM_INT);
	if($stmt->execute())
		return $pdo->lastInsertId();
	else
		return false;
}
function recuperer_messages($id_sujet) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT f.id id_sujet, f.*, m.id id_membre, m.* FROM forum_messages AS f
																				JOIN membres AS m ON f.id_membre = m.id
																			WHERE id_sujet = :id_sujet');
	$stmt->bindValue('id_sujet', $id_sujet, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll();
}