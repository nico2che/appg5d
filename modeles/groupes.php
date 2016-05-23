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

function ajouter_date($id_groupe, $date, $localisation, $coordonnees, $duree) {

	global $pdo;
	$stmt = $pdo->prepare('INSERT INTO dates_rencontres SET id_groupe = :id_groupe,
															date = :date,
															localisation = :localisation,
															coordonnees = :coordonnees,
															duree = :duree');
	$stmt->bindValue('id_groupe', $id_groupe, PDO::PARAM_INT);
	$stmt->bindValue('date', $date, PDO::PARAM_STR);
	$stmt->bindValue('localisation', $localisation, PDO::PARAM_STR);
	$stmt->bindValue('coordonnees', $coordonnees, PDO::PARAM_STR);
	$stmt->bindValue('duree', $duree, PDO::PARAM_STR);
	if($stmt->execute())
		return $pdo->lastInsertId();
	else
		return false;
}

function ajouter_membre_date($id_date, $id_membre) {

	global $pdo;
	$stmt = $pdo->prepare('INSERT INTO dates_membres SET id_date = :id_date,
															id_membre = :id_membre');
	$stmt->bindValue('id_date', $id_date, PDO::PARAM_INT);
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	if($stmt->execute())
		return $pdo->lastInsertId();
	else
		return false;
}

function ajouter_membre_groupe($id_groupe, $id_membre, $type) {

	global $pdo;
	$stmt = $pdo->prepare('INSERT INTO groupes_membres SET id_groupe = :id_groupe,
															type = :type,
															id_membre = :id_membre');
	$stmt->bindValue('id_groupe', $id_groupe, PDO::PARAM_INT);
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	$stmt->bindValue('type', $type, PDO::PARAM_INT);
	if($stmt->execute())
		return $pdo->lastInsertId();
	else
		return false;
}

function supprimer_membre_date($id_date, $id_membre) {

	global $pdo;
	$stmt = $pdo->prepare('DELETE FROM dates_membres WHERE id_date = :id_date AND id_membre = :id_membre');
	$stmt->bindValue('id_date', $id_date, PDO::PARAM_INT);
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	if($stmt->execute())
		return true;
	else
		return false;
}

function supprimer_date($id_date) {

	global $pdo;
	$stmt = $pdo->prepare('DELETE FROM dates_rencontres WHERE id = :id_date');
	$stmt->bindValue('id_date', $id_date, PDO::PARAM_INT);
	if($stmt->execute())
		return true;
	else
		return false;
}

function infos_groupe($id) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT s.nom AS nom_sport, g.* 	FROM groupes_membres AS g_m
																RIGHT JOIN groupes AS g ON g.id = g_m.id_groupe
																LEFT JOIN membres AS m ON m.id = g_m.id_membre
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
	$resultat = array('tous' => array(), 'types' => array());
	while($ligne = $stmt->fetch()) {
		$resultat['tous'][] = $ligne;
		$resultat['types'][$ligne['type']][] = $ligne;
	}
	return $resultat;
}

function est_membre_groupe($id_groupe, $id_membre) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT g_m.type AS type, m.* FROM groupes_membres AS g_m
															JOIN groupes AS g ON g.id = g_m.id_groupe
															JOIN membres AS m ON m.id = g_m.id_membre
														WHERE g.id = :id_groupe AND m.id = :id_membre');
	$stmt->bindValue('id_groupe', $id_groupe, PDO::PARAM_INT);
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	$stmt->execute();
	return (!empty($stmt->fetch()));
}

function dates_groupe($id) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT d.* , m.* FROM groupes AS g
												JOIN dates_rencontres AS d ON d.id_groupe = g.id
												LEFT JOIN dates_membres AS m ON m.id_date = d.id
											WHERE g.id = :id
											ORDER BY d.date');
	$stmt->bindValue('id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$resultat = array();
	while($ligne = $stmt->fetch()) {
		$resultat[$ligne[0]]['infos'] = $ligne;
		$resultat[$ligne[0]]['membres'][] = $ligne['id_membre'];
	}
	return $resultat;
}

function dates_membre($id_membre) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT *	FROM dates_membres WHERE id_membre = :id_membre');
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	$stmt->execute();
	$resultat = array();
	while($ligne = $stmt->fetch()) {
		$resultat[] = $ligne;
	}
	return $resultat;
}

function modifier_groupe($id_groupe, $titre, $sport, $description, $min_participants, $max_participants, $visibilite, $recurrence, $niveau) {

	global $pdo;
	$stmt = $pdo->prepare('UPDATE groupes SET titre = :titre,
												id_sport = :sport,
												description = :description,
												min_participants = :min_participants,
												max_participants = :max_participants,
												visibilite = :visibilite,
												recurrence = :recurrence,
												niveau = :niveau
											WHERE id = :id_groupe');
	$stmt->bindValue('id_groupe', $id_groupe, PDO::PARAM_INT);
	$stmt->bindValue('titre', $titre, PDO::PARAM_STR);
	$stmt->bindValue('sport', $sport, PDO::PARAM_INT);
	$stmt->bindValue('description', $description, PDO::PARAM_STR);
	$stmt->bindValue('min_participants', $min_participants, PDO::PARAM_INT);
	$stmt->bindValue('max_participants', $max_participants, PDO::PARAM_INT);
	$stmt->bindValue('visibilite', $visibilite, PDO::PARAM_STR);
	$stmt->bindValue('recurrence', $recurrence, PDO::PARAM_STR);
	$stmt->bindValue('niveau', $niveau, PDO::PARAM_INT);
	if($stmt->execute())
		return true;
	else
		return false;
}

function ajouter_groupe($titre, $sport, $description, $min_participants, $max_participants, $visibilite, $recurrence, $niveau) {

	global $pdo;
	$stmt = $pdo->prepare('INSERT INTO groupes SET titre = :titre,
													id_sport = :sport,
													description = :description,
													min_participants = :min_participants,
													max_participants = :max_participants,
													visibilite = :visibilite,
													recurrence = :recurrence,
													id_club = 0,
													niveau = :niveau');
	$stmt->bindValue('titre', $titre, PDO::PARAM_STR);
	$stmt->bindValue('sport', $sport, PDO::PARAM_INT);
	$stmt->bindValue('description', $description, PDO::PARAM_STR);
	$stmt->bindValue('min_participants', $min_participants, PDO::PARAM_INT);
	$stmt->bindValue('max_participants', $max_participants, PDO::PARAM_INT);
	$stmt->bindValue('visibilite', $visibilite, PDO::PARAM_STR);
	$stmt->bindValue('recurrence', $recurrence, PDO::PARAM_STR);
	$stmt->bindValue('niveau', $niveau, PDO::PARAM_INT);
	if($stmt->execute())
		return $pdo->lastInsertId();
	else
		return false;
}