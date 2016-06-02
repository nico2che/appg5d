<?php

/* sujets */
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
function recuperer_sujets_sport($id_sport, $debut_requete, $sujets_par_page) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT SQL_CALC_FOUND_ROWS f.id id_sujet, f.*, m.id id_membre, m.* FROM forum_sujets AS f
																				JOIN membres AS m ON f.id_membre = m.id
																			WHERE id_sport = :id_sport ORDER BY date DESC
																			LIMIT :debut_requete, :sujets_par_page');
	$stmt->bindValue('id_sport', $id_sport, PDO::PARAM_INT);
	$stmt->bindValue('debut_requete', $debut_requete, PDO::PARAM_INT);
	$stmt->bindValue('sujets_par_page', $sujets_par_page, PDO::PARAM_INT);
	$stmt->execute();
	return array('nombre' => $pdo->query('SELECT FOUND_ROWS();')->fetch(PDO::FETCH_COLUMN), 'lignes' => $stmt->fetchAll());
}
function ajouter_sujet($titre, $contenu, $sport) {

	global $pdo;
	$stmt = $pdo->prepare('INSERT INTO forum_sujets SET 	titre = :titre,
															message = :contenu,
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
function sujet_auteur($id_membre, $id) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT COUNT(*) AS nbre FROM forum_sujets WHERE id = :id AND id_membre = :id_membre');
	$stmt->bindValue('id', $id, PDO::PARAM_INT);
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	$stmt->execute();
	$resultat = $stmt->fetch();
	return $resultat['nbre'];
}
function supprimer_sujet($id) {

	global $pdo;
	$stmt = $pdo->prepare('DELETE FROM forum_sujets WHERE id = :id');
	$stmt->bindValue('id', $id, PDO::PARAM_INT);
	return $stmt->execute();
}
function modifier_sujet($id, $titre, $message) {

	global $pdo;
	$stmt = $pdo->prepare('UPDATE forum_sujets SET titre = :titre,
													message = :message
												WHERE id = :id');
	$stmt->bindValue('id', $id, PDO::PARAM_INT);
	$stmt->bindValue('titre', $titre, PDO::PARAM_STR);
	$stmt->bindValue('message', $message, PDO::PARAM_STR);
	return $stmt->execute();
}

/* messages */
function recuperer_messages($id_sujet) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT f.id id_message, f.*, m.id id_membre, m.* FROM forum_messages AS f
																				JOIN membres AS m ON f.id_membre = m.id
																			WHERE f.id_sujet = :id_sujet');
	$stmt->bindValue('id_sujet', $id_sujet, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll();
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
function message_auteur($id_membre, $id) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT COUNT(*) AS nbre FROM forum_messages WHERE id = :id AND id_membre = :id_membre');
	$stmt->bindValue('id', $id, PDO::PARAM_INT);
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	$stmt->execute();
	$resultat = $stmt->fetch();
	return $resultat['nbre'];
}
function supprimer_message($id) {

	global $pdo;
	$stmt = $pdo->prepare('DELETE FROM forum_messages WHERE id = :id');
	$stmt->bindValue('id', $id, PDO::PARAM_INT);
	return $stmt->execute();
}