<?php  

function list_club(){
	global $pdo;
	$stmt = $pdo->query('SELECT * FROM clubs');

	while($ligne = $stmt->fetch()) {
		$resultat[] = $ligne;
	}
	return $resultat;

}

function recherche_club($idS){
	global $pdo;
	$stmt = $pdo-> prepare('SELECT id FROM clubs WHERE SELECT id_sport FROM sport_club WHERE id_sports= :idS');

	$stmt->bindValue('idS', $idS, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetch();



}
function sport_club($idC){
	global $pdo;
	$stmt = $pdo-> prepare('SELECT * FROM sport_club WHERE id_clubs= :idC');
	
	$stmt->bindValue('idC', $idC, PDO::PARAM_INT);
	$stmt->execute();
	$resultat = array();

	while($ligne = $stmt->fetch()) {
		$resultat[] = $ligne;
	}
	return $resultat;
	



}

function sport_id($id){
	global $pdo;
	$stmt = $pdo-> prepare('SELECT nom FROM sports WHERE id= :id');

	$stmt->bindValue('id', $id, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetch();

}

function info_club($idt){
	global $pdo;
	$stmt = $pdo-> prepare('SELECT * FROM clubs WHERE id=:idt');

	$stmt->bindValue('idt', $idt, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetch();
}

function commentaire($idC){
	global $pdo;
	$stmt = $pdo-> prepare('SELECT * FROM commentaires_clubs WHERE id_club=:idC');
	
	$stmt->bindValue('idC', $idC, PDO::PARAM_INT);
	$stmt->execute();
	$resultat = array();

	while($ligne = $stmt->fetch()) {
		$resultat[] = $ligne;
	}
	return $resultat;

}

function idM_nomM($idM){
	global $pdo;
	$stmt = $pdo-> prepare('SELECT nom,prenom FROM membres WHERE id=:idM');

	$stmt->bindValue('idM', $idM, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetch();
}

function ajouterCommentaire($idC,$idM,$Comment,$note){
	global $pdo;

	$stmt = $pdo-> prepare('INSERT INTO commentaires_clubs SET id_club= :idC, id_membre= :idM, commentaire= :comment, note= :note');
	$stmt->bindValue('idC', $idC, PDO::PARAM_STR);
	$stmt->bindValue('idM', $idM, PDO::PARAM_STR);
	$stmt->bindValue('comment', $Comment, PDO::PARAM_STR);
	$stmt->bindValue('note', $note, PDO::PARAM_STR);

	if($stmt->execute())
		return $pdo->lastInsertId();
	else
		return false;
}

function DejaCommenter($idM){
	global $pdo;
	$stmt = $pdo-> prepare('SELECT * FROM commentaires_clubs WHERE id_membre= :idM');
	$stmt->bindValue('idM', $idM, PDO::PARAM_STR);

	$stmt->execute();
	return $stmt->fetch();


}

function modifierComment($Comment,$note,$idM){
	global $pdo;
		$stmt = $pdo->prepare('UPDATE commentaires_clubs SET commentaire =:comment, note= :note WHERE id_membre=:idM');

		$stmt->bindValue('comment', $Comment, PDO::PARAM_STR);
		$stmt->bindValue('note', $note, PDO::PARAM_STR);
		$stmt->bindValue('idM', $idM, PDO::PARAM_STR);

		return $stmt->execute();
}

