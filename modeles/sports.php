<?php

function ajouter_sport($nom, $description = '') {
	global $mysqli;
	$requete = $mysqli->prepare('INSERT INTO sports SET nom = ?, description = ?');
	$requete->bind_param('ss', $nom, $description);
	$requete->execute();
	if(isset($mysqli->error) && !empty($mysqli->error))
		return false;
	else
		return $mysqli->insert_id;
}