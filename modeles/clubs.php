<?php  

function recuperer_clubs(){
	global $pdo;
	$stmt = $pdo->query('SELECT c.nom AS nom_club, c.id AS id_club, c.*, s.* FROM clubs AS c
												LEFT JOIN sport_club AS sc ON sc.id_clubs = c.id
												LEFT JOIN sports AS s ON sc.id_sports = s.id');
	$resultat = array();
	while($ligne = $stmt->fetch()) {
		$resultat[$ligne[0]][] = $ligne;
	}
	return $resultat;

}
function recuperer_departement(){
	global $pdo;
	return $pdo->query('SELECT * FROM departement');
}
function recuperer_clubs_sport_departement($id_sport, $id_departement){
	global $pdo;
	$stmt = $pdo-> prepare('SELECT c.nom AS nom_club, c.id AS id_club, c.*, s.* FROM clubs AS c
													JOIN sport_club AS sc ON sc.id_clubs = c.id
													JOIN sports AS s ON sc.id_sports = s.id
												WHERE c.departement_id = :id_departement AND sc.id_sports = :id_sport');

	$stmt->bindValue('id_sport', $id_sport, PDO::PARAM_INT);
	$stmt->bindValue('id_departement', $id_departement, PDO::PARAM_INT);
	$stmt->execute();
	$resultat = array();
	while($ligne = $stmt->fetch()) {
		$resultat[$ligne[0]][] = $ligne;
	}
	return $resultat;
}
function recuperer_clubs_sport($id_sport){
	global $pdo;
	$stmt = $pdo-> prepare('SELECT c.nom AS nom_club, c.id AS id_club, c.*, s.* FROM clubs AS c
													JOIN sport_club AS sc ON sc.id_clubs = c.id
													JOIN sports AS s ON sc.id_sports = s.id
												WHERE sc.id_sports = :id_sport');

	$stmt->bindValue('id_sport', $id_sport, PDO::PARAM_INT);
	$stmt->execute();
	$resultat = array();
	while($ligne = $stmt->fetch()) {
		$resultat[$ligne[0]][] = $ligne;
	}
	return $resultat;
}
function recuperer_clubs_departement($id_departement){
	global $pdo;
	$stmt = $pdo-> prepare('SELECT c.nom AS nom_club, c.id AS id_club, c.*, s.* FROM clubs AS c
													JOIN sport_club AS sc ON sc.id_clubs = c.id
													JOIN sports AS s ON sc.id_sports = s.id
												WHERE c.departement_id = :id_departement');

	$stmt->bindValue('id_departement', $id_departement, PDO::PARAM_INT);
	$stmt->execute();
	$resultat = array();
	while($ligne = $stmt->fetch()) {
		$resultat[$ligne[0]][] = $ligne;
	}
	return $resultat;
}

function recuperer_club($id_club){
	global $pdo;
	$stmt = $pdo-> prepare('SELECT c.*, m.nom AS nom_membre, m.prenom AS prenom_membre, cc.id AS id_commentaire, cc.*, s.nom AS nom_sport
												FROM clubs AS c
													LEFT JOIN commentaires_clubs cc ON cc.id_club = c.id
													LEFT JOIN membres m ON m.id = cc.id_membre
													LEFT JOIN sport_club AS sc ON sc.id_clubs = c.id
													LEFT JOIN sports AS s ON sc.id_sports = s.id
												WHERE c.id = :id_club');
	$stmt->bindValue('id_club', $id_club, PDO::PARAM_INT);
	$stmt->execute();
	$resultat = array();
	while($ligne = $stmt->fetch()) {
		$resultat['club'] = $ligne;
		$resultat['commentaires'][$ligne['id_commentaire']] = $ligne;
		$resultat['sports'][$ligne['nom_sport']] = $ligne;
	}
	return $resultat;
}

/* Commentaires */
function ajouterCommentaire($id_club, $id_membre, $commentaire, $note){
	global $pdo;
	$stmt = $pdo-> prepare('INSERT INTO commentaires_clubs SET id_club = :id_club,
																id_membre = :id_membre,
																commentaire = :commentaire,
																note = :note');
	$stmt->bindValue('id_club', $id_club, PDO::PARAM_INT);
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	$stmt->bindValue('commentaire', $commentaire, PDO::PARAM_STR);
	$stmt->bindValue('note', $note, PDO::PARAM_STR);
	if($stmt->execute())
		return $pdo->lastInsertId();
	else
		return false;
}
function dejaCommente($id_membre, $id_club){
	global $pdo;
	$stmt = $pdo-> prepare('SELECT * FROM commentaires_clubs WHERE id_membre= :id_membre AND id_club= :id_club');
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	$stmt->bindValue('id_club', $id_club, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetch();
}
function modifierCommentaire($id_club, $id_membre, $commentaire, $note){
	global $pdo;
	$stmt = $pdo->prepare('UPDATE commentaires_clubs SET commentaire = :commentaire,
															note = :note
														WHERE id_club = :id_club AND id_membre = :id_membre');
	$stmt->bindValue('commentaire', $commentaire, PDO::PARAM_STR);
	$stmt->bindValue('note', $note, PDO::PARAM_INT);
	$stmt->bindValue('id_club', $id_club, PDO::PARAM_INT);
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	$stmt->execute();
	if($stmt->execute())
		return true;
	else
		return false;
}