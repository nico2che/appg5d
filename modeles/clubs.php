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