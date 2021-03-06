<?php

/* Récupérer les groupes */
function recuperer_groupes($debut, $combien) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT SQL_CALC_FOUND_ROWS g.id AS id_groupe, s.nom AS nom_sport, g.*, COUNT(*) AS nbre FROM groupes AS g
																									JOIN sports AS s ON s.id = g.id_sport
																									LEFT JOIN groupes_membres gm ON gm.id_groupe = g.id
																								GROUP BY g.id
																								LIMIT :debut, :combien');
	
	$stmt->bindValue('debut', $debut, PDO::PARAM_INT);
	$stmt->bindValue('combien', $combien, PDO::PARAM_INT);

	$stmt->execute();
	return array('nombre' => $pdo->query('SELECT FOUND_ROWS();')->fetch(PDO::FETCH_COLUMN), 'lignes' => $stmt->fetchAll());
}
/* Rechercher les groupes */
function rechercher_groupe($titre, $id_sport, $recurrence, $requete, $debut, $combien) {
	global $pdo;
	$stmt = $pdo->prepare('SELECT SQL_CALC_FOUND_ROWS g.id id_groupe, g.*, s.*, COUNT(*) AS nbre FROM groupes g
																				JOIN sports s ON s.id = g.id_sport
																				LEFT JOIN groupes_membres gm ON gm.id_groupe = g.id
																			WHERE ' . $requete . '
																			GROUP BY g.id
																			LIMIT :debut, :combien');

	if(!empty($titre))
		$stmt->bindValue('titre', '%'.$titre.'%', PDO::PARAM_STR);
	if(!empty($id_sport))
		$stmt->bindValue('id_sport', $id_sport, PDO::PARAM_INT);
	if(!empty($recurrence))
		$stmt->bindValue('recurrence', $recurrence, PDO::PARAM_STR);
	
	$stmt->bindValue('debut', $debut, PDO::PARAM_INT);
	$stmt->bindValue('combien', $combien, PDO::PARAM_INT);

	$stmt->execute();
	return array('nombre' => $pdo->query('SELECT FOUND_ROWS();')->fetch(PDO::FETCH_COLUMN), 'lignes' => $stmt->fetchAll());
}
/* Recherche avancée des groupes */
function rechercher_groupe_avancee($titre, $id_sport, $recurrence, $min, $max, $departement, $niveau, $requete, $debut, $combien) {
	global $pdo;
	$stmt = $pdo->prepare('SELECT SQL_CALC_FOUND_ROWS s.nom AS nom_sport, g.id AS id_groupe, g.*, s.*, COUNT(*) AS nbre FROM groupes g
																										JOIN sports s ON s.id = g.id_sport
																										LEFT JOIN groupes_membres gm ON gm.id_groupe = g.id
																									WHERE ' . $requete . '
																									GROUP BY g.id
																									LIMIT :debut, :combien');

	if(!empty($titre))
		$stmt->bindValue('titre', '%'.$titre.'%', PDO::PARAM_STR);
	if(!empty($id_sport))
		$stmt->bindValue('id_sport', $id_sport, PDO::PARAM_INT);
	if(!empty($recurrence))
		$stmt->bindValue('recurrence', $recurrence, PDO::PARAM_STR);
	if(!empty($min))
		$stmt->bindValue('min', $min, PDO::PARAM_INT);
	if(!empty($max))
		$stmt->bindValue('max', $max, PDO::PARAM_INT);
	if(!empty($departement))
		$stmt->bindValue('departement', $departement, PDO::PARAM_INT);
	if(!empty($niveau))
		$stmt->bindValue('niveau', $niveau, PDO::PARAM_INT);
	
	$stmt->bindValue('debut', $debut, PDO::PARAM_INT);
	$stmt->bindValue('combien', $combien, PDO::PARAM_INT);

	$stmt->execute();

	return array('nombre' => $pdo->query('SELECT FOUND_ROWS();')->fetch(PDO::FETCH_COLUMN), 'lignes' => $stmt->fetchAll());
}
/* Récupérer les informations d'un groupe précis */
function infos_groupe($id) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT s.nom AS nom_sport, s.id AS id_sport, g.*, d.departement_nom, d.departement_code FROM groupes_membres AS g_m
																RIGHT JOIN groupes AS g ON g.id = g_m.id_groupe
																LEFT JOIN membres AS m ON m.id = g_m.id_membre
																JOIN sports AS s ON s.id = g.id_sport
																LEFT JOIN departement d ON d.departement_id = g.id_departement
															WHERE g.id = :id');
	$stmt->bindValue('id', $id, PDO::PARAM_INT);
	$stmt->execute();
	return $ligne = $stmt->fetch();
}
/* Récupérer les groupes d'un mois précis */
function recuperer_groupes_mois($mois, $id_membre) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT d_r.*, g.* FROM dates_rencontres AS d_r
												INNER JOIN groupes AS g ON g.id = d_r.id_groupe
												LEFT JOIN groupes_membres AS g_m ON g_m.id_groupe = g.id
											WHERE MONTH(d_r.date) = :mois AND g_m.id_membre = :id_membre');
	$stmt->bindValue('mois', $mois, PDO::PARAM_INT);
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	$stmt->execute();
	$resultat = array();
	while($ligne = $stmt->fetch()) {
		$date = new DateTimeFrench($ligne['date']);
		$resultat[$date->format('Y-m-d')][] = $ligne;
	}
	return $resultat;
}
/* Récupérer les groupes d'un mois précis */
function recuperer_groupes_membre($id_membre) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT s.nom AS nom_sport, g_m.*, g.*, m.* FROM groupes_membres g_m
												LEFT JOIN membres AS m ON g_m.id_membre = m.id
												LEFT JOIN groupes AS g ON g_m.id_groupe = g.id
												LEFT JOIN sports AS s ON s.id = g.id_sport
											WHERE g_m.id_membre = :id_membre');
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	$stmt->execute();
	$resultat = array();
	while($ligne = $stmt->fetch()) {
		$resultat['tous'][] = $ligne;
		$resultat['types'][$ligne['type']][] = $ligne;
	}
	return $resultat;
}
/* Ajouter un groupe */
function ajouter_groupe($titre, $sport, $departement, $description, $min_participants, $max_participants, $visibilite, $recurrence, $niveau) {

	global $pdo;
	$stmt = $pdo->prepare('INSERT INTO groupes SET titre = :titre,
													id_sport = :sport,
													id_departement = :departement,
													description = :description,
													min_participants = :min_participants,
													max_participants = :max_participants,
													visibilite = :visibilite,
													recurrence = :recurrence,
													id_club = 0,
													tendance = 0,
													niveau = :niveau');
	$stmt->bindValue('titre', $titre, PDO::PARAM_STR);
	$stmt->bindValue('sport', $sport, PDO::PARAM_INT);
	$stmt->bindValue('departement', $departement, PDO::PARAM_INT);
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
/* Modifier un groupe */
function modifier_groupe($id_groupe, $titre, $sport, $departement, $description, $min_participants, $max_participants, $visibilite, $recurrence, $niveau) {

	global $pdo;
	$stmt = $pdo->prepare('UPDATE groupes SET titre = :titre,
												id_sport = :sport,
												id_departement = :departement,
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
	$stmt->bindValue('departement', $departement, PDO::PARAM_INT);
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
/* Supprimer un groupe */
function supprimer_groupe($id_groupe) {

	global $pdo;
	$stmt = $pdo->prepare('DELETE dm, dr, gm, g FROM dates_membres dm INNER JOIN dates_rencontres dr ON dm.id_date = dr.id
																INNER JOIN groupes_membres gm ON gm.id_groupe = :id_groupe
																INNER JOIN groupes g ON g.id = :id_groupe
															WHERE dr.id_groupe = :id_groupe');
	$stmt->bindValue('id_groupe', $id_groupe, PDO::PARAM_INT);
	if($stmt->execute())
		return true;
	else
		return false;
}

/* Lister les membres d'un groupe */
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
/* Ajouter un membre à un groupe */
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
/* Promouvoir un membre en tant que responsable d'un groupe */
function promouvoir_membre_groupe($id_groupe, $id_membre) {

	global $pdo;
	$stmt = $pdo->prepare('UPDATE groupes_membres SET type = 1
											WHERE id_groupe = :id_groupe AND id_membre = :id_membre');
	$stmt->bindValue('id_groupe', $id_groupe, PDO::PARAM_INT);
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	if($stmt->execute())
		return true;
	else
		return false;
}
/* Rétrograde un membre en tant que responsable d'un groupe */
function retrograde_membre_groupe($id_groupe, $id_membre) {

	global $pdo;
	$stmt = $pdo->prepare('UPDATE groupes_membres SET type = 0
											WHERE id_groupe = :id_groupe AND id_membre = :id_membre');
	$stmt->bindValue('id_groupe', $id_groupe, PDO::PARAM_INT);
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	if($stmt->execute())
		return true;
	else
		return false;
}
/* Supprimer un membre d'un groupe */
function supprimer_membre_groupe($id_groupe, $id_membre) {

	global $pdo;
	$stmt = $pdo->prepare('DELETE FROM groupes_membres WHERE id_groupe = :id_groupe AND id_membre = :id_membre');
	$stmt->bindValue('id_groupe', $id_groupe, PDO::PARAM_INT);
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	if($stmt->execute())
		return true;
	else
		return false;
}
/* Supprimer les dates d'un membre, d'un groupe */
function supprimer_dates_rencontres_membres($id_groupe, $id_membre) {

	global $pdo;
	$stmt = $pdo->prepare('DELETE dm FROM dates_membres dm LEFT JOIN dates_rencontres dr ON dm.id_date = dr.id
															WHERE dr.id_groupe = :id_groupe AND dm.id_membre = :id_membre');
	$stmt->bindValue('id_groupe', $id_groupe, PDO::PARAM_INT);
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	if($stmt->execute())
		return true;
	else
		return false;
}
/* Lister les dates de rencontre d'un membre */
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
/* Lister les dates de rencontre d'un groupe */
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
/* Ajouter une date de rencontre dans un groupe */
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
/* Supprimer une date de rencontre dans un groupe */
function supprimer_date($id_date) {

	global $pdo;
	$stmt = $pdo->prepare('DELETE FROM dates_rencontres WHERE id = :id_date');
	$stmt->bindValue('id_date', $id_date, PDO::PARAM_INT);
	if($stmt->execute())
		return true;
	else
		return false;
}

/* Ajouter un membre à une date de rencontre */
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
/* Supprimer un membre à une date de rencontre */
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



function est_auteur_groupe($membres) {
	return isset($membres['types'][1][0]['id']) && isset($_SESSION['id']) && $membres['types'][1][0]['id'] == $_SESSION['id'];
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
	$resultat = $stmt->fetch();
	return (!empty($resultat) ? $resultat : false);
}

