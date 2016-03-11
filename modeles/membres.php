<?php

function existe_email($email) {
	global $mysqli;
	$requete = $mysqli->query('SELECT email FROM membres WHERE email = "' .$email. '"');
	if(empty($requete->fetch_array()))
		return false;
	else
		return true;
}

function inscrire_membre($nom, $prenom, $email, $mot_de_passe) {
	global $mysqli;
	$requete = $mysqli->prepare('INSERT INTO membres SET nom = ?, prenom = ?, email = ?, mot_de_passe = ?');
	$requete->bind_param('ssss', $nom, $prenom, $email, $mot_de_passe);
	$requete->execute();
	if(isset($mysqli->error) && !empty($mysqli->error))
		return false;
	else
		return $mysqli->insert_id;
}