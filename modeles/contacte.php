<?php

function formulaire_contacte($nom,$email,$sujet,$contenu){
	global $mysqli;

	$requete=$mysqli -> prepare('INSERT INTO contacte_message VALUES name= ?,email= ?,sujet= ?,contenu= ?');
	$requete->bind_param($nom, $email, $sujet, $contenu);
	$requete-> execute();

	if(isset($mysqli->error) && !empty($mysqli->error))
		return false;
	else
		return $mysqli->insert_id;
}

