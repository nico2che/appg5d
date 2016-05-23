<?php

function connecte() {
	return isset($_SESSION['id']);
}

function chemin_avatar($fichier) {
	return DOSSIER_AVATAR . $fichier . '.jpg';
}

function existe_email($email) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT email FROM membres WHERE email = :email');
	$stmt->bindValue('email', $email, PDO::PARAM_STR);
	if($stmt->execute())
		return $stmt->fetch();
	else
		return false;
}

function inscrire_membre($nom, $prenom, $email, $mot_de_passe) {

	global $pdo;
	$stmt = $pdo->prepare('INSERT INTO membres SET 	nom = :nom,
													prenom = :prenom,
													email = :email,
													mot_de_passe = :mot_de_passe,
													description = ""');
	$stmt->bindValue('nom', $nom, PDO::PARAM_STR);
	$stmt->bindValue('prenom', $prenom, PDO::PARAM_STR);
	$stmt->bindValue('email', $email, PDO::PARAM_STR);
	$stmt->bindValue('mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
	if($stmt->execute())
		return $pdo->lastInsertId();
	else
		return false;
}

function connexion_membre($email, $mot_de_passe) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT * FROM membres WHERE email = :email AND mot_de_passe = :mot_de_passe');
	$stmt->bindValue('email', $email, PDO::PARAM_STR);
	$stmt->bindValue('mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
	if($stmt->execute())
		return $stmt->fetch();
	else
		return false;
}

function profil_membre($id) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT * FROM membres WHERE id = :id');
	$stmt->bindValue('id', $id, PDO::PARAM_INT);
	if($stmt->execute())
		return $stmt->fetch();
	else
		return false;
}

function modifier_membre($id_membre, $nom, $prenom, $email) {

	global $pdo;
	$stmt = $pdo->prepare('UPDATE membres SET nom = :nom, prenom = :prenom, email = :email WHERE id = :id_membre');
	$stmt->bindValue('nom', $nom, PDO::PARAM_STR);
	$stmt->bindValue('prenom', $prenom, PDO::PARAM_STR);
	$stmt->bindValue('email', $email, PDO::PARAM_STR);
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	return $stmt->execute();
}