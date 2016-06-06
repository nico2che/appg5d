<?php

include 'modeles/clubs.php';
include 'modeles/groupes.php';

$fichier_css = 'mon-profil';
$moi = false;

if(connecte() && (!isset($_GET['id']) || $_SESSION['id'] == $_GET['id'])) {

	$id_membre = (int) $_SESSION['id'];
	$moi = true;

	$invitations = recuperer_invitations($id_membre);

	$informations = profil_membre($id_membre);

	$calendrier = new DateTimeFrench('last day of this month');
	$nombre_jours = $calendrier->format('j');

	$calendrier->modify('first day of this month');
	$groupes_ce_mois = recuperer_groupes_mois($calendrier->format('n'), $id_membre);

	$calendrier->modify('1 months');
	$groupes_mois_prochain = recuperer_groupes_mois($calendrier->format('n'), $id_membre);

} elseif(isset($_GET['id']) && !empty($_GET['id'])) {

	$id_membre = (int) $_GET['id'];

	$informations = profil_membre($id_membre);
}

include 'vues/profil.php';