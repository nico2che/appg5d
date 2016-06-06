<?php

if(!connecte()) {
	header('Location: ./');
	exit();
}

include 'modeles/groupes.php';

$fichier_css = 'mon-profil';

$calendrier = new DateTimeFrench('last day of this month');
$nombre_jours = $calendrier->format('j');

$calendrier->modify('first day of this month');
$groupes_ce_mois = recuperer_groupes_mois($calendrier->format('n'), $_SESSION['id']);

$calendrier->modify('1 months');
$groupes_mois_prochain = recuperer_groupes_mois($calendrier->format('n'), $_SESSION['id']);

include 'vues/mes-groupes.php';