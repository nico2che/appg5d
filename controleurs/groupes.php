<?php

include 'modeles/groupes.php';
include 'modeles/sports.php';

if(isset($_GET['nom']) && isset($_GET['sport']) && isset($_GET['recurrence'])) {

	$requete = '';
	if(!empty($_GET['nom']))
		$requete .= ' titre LIKE :titre AND';
	if(!empty($_GET['sport']))
		$requete .= ' id_sport = :id_sport AND';
	if(!empty($_GET['recurrence']))
		$requete .= ' recurrence = :recurrence AND';
	$requete .= ' 1=1';
	$groupes = rechercher_groupe($_GET['nom'], $_GET['sport'], $_GET['recurrence'], $requete);
	echo json_encode($groupes);
	usleep(500000); // miaou
	exit();
}

$groupes = recuperer_groupes();
$sports = recuperer_sports();

include 'vues/groupes.php';