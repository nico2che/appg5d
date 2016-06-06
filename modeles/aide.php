<?php  

function recuperer_aide(){
	global $pdo;
	$resultat = $pdo->query('SELECT * FROM aide');
	return $resultat->fetchAll();
}