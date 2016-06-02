<?php

function connecte($profil = false) {

	if(!$profil) {
		
		return isset($_SESSION['id']);

	} else {

		return (isset($_SESSION['id']) ? profil_membre($_SESSION['id']) : false);
	}
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

function inscrire_membre($nom, $prenom, $email, $mot_de_passe, $sexe, $id_departement) {

	global $pdo;
	$stmt = $pdo->prepare('INSERT INTO membres SET 	nom = :nom,
													prenom = :prenom,
													email = :email,
													mot_de_passe = :mot_de_passe,
													sexe = :sexe,
													id_departement = :id_departement,
													description = ""');
	$stmt->bindValue('nom', $nom, PDO::PARAM_STR);
	$stmt->bindValue('prenom', $prenom, PDO::PARAM_STR);
	$stmt->bindValue('email', $email, PDO::PARAM_STR);
	$stmt->bindValue('mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
	$stmt->bindValue('sexe', $sexe, PDO::PARAM_STR);
	$stmt->bindValue('id_departement', $id_departement, PDO::PARAM_INT);
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
function verifier_membre($id, $mot_de_passe) {

	global $pdo;
	$stmt = $pdo->prepare('SELECT * FROM membres WHERE id = :id AND mot_de_passe = :mot_de_passe');
	$stmt->bindValue('id', $id, PDO::PARAM_STR);
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

function modifier_membre($id_membre, $nom, $prenom, $email, $sexe, $description, $id_departement) {

	global $pdo;
	$stmt = $pdo->prepare('UPDATE membres SET nom = :nom, prenom = :prenom, email = :email, sexe = :sexe, description = :description, id_departement = :id_departement WHERE id = :id_membre');
	$stmt->bindValue('nom', $nom, PDO::PARAM_STR);
	$stmt->bindValue('prenom', $prenom, PDO::PARAM_STR);
	$stmt->bindValue('email', $email, PDO::PARAM_STR);
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	$stmt->bindValue('sexe', $sexe, PDO::PARAM_STR);
	$stmt->bindValue('description', $description, PDO::PARAM_STR);
	$stmt->bindValue('id_departement', $id_departement, PDO::PARAM_INT);
	return $stmt->execute();
}

function modifier_mot_de_passe($id_membre, $mot_de_passe) {

	global $pdo;
	$stmt = $pdo->prepare('UPDATE membres SET mot_de_passe = :mot_de_passe WHERE id = :id_membre');
	$stmt->bindValue('id_membre', $id_membre, PDO::PARAM_INT);
	$stmt->bindValue('mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
	return $stmt->execute();
}