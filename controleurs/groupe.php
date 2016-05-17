<?php

include 'modeles/groupes.php';
include 'modeles/sports.php';

$mois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

$id_groupe = (int) $_GET['id'];

function genererSelect($debut, $fin, $selected = null, $zero = false) {
	for ($i=$debut; $i < ($fin + 1); $i++) { 
		echo '<option '.($i == $selected ? 'selected=""' : null).' value="'.$i.'">'.($i < 10 && $zero ? '0'.$i : $i).'</option>';
	}
}

$messages = array();

if(isset($_POST['jour']) && isset($_POST['mois']) && isset($_POST['annee']) && isset($_POST['heure']) && isset($_POST['minute']) && isset($_POST['localisation']) && isset($_POST['duree_heure']) && isset($_POST['duree_minute'])) {

	if(!empty($_POST['jour']) && !empty($_POST['mois']) && !empty($_POST['annee']) && !empty($_POST['localisation'])) {

		$dateTime = new DateTime($_POST['annee'].'-'.$_POST['mois'].'-'.$_POST['jour'].' '.$_POST['heure'].':'.$_POST['minute']);

		if(ajouter_date($id_groupe, $dateTime->format('Y-m-d'), $_POST['localisation'], $_POST['duree_heure'].':'.$_POST['duree_minute'])) {

			$messages['type'] = 'succes';
			$messages['message'] = 'La date a bien été ajoutée !';

		} else {

			$messages['type'] = 'erreur';
			$messages['message'] = 'Impossible de rajouter cette date.';
		}

	} else {

		$messages['type'] = 'erreur';
		$messages['message'] = 'Tous les champs sont obligatoires.';
	}
}

$infos_groupe = infos_groupe($id_groupe);
$membres_groupe = membres_groupe($id_groupe);
$dates_groupe = dates_groupe($id_groupe);

if(isset($_GET['modifier']) && est_auteur_groupe($membres_groupe)) {

	$sports = recuperer_sports();
	include 'vues/groupe-modifier.php';

} elseif(isset($_GET['supprimer']) && est_auteur_groupe($membres_groupe)) {

	include 'vues/groupe.php';

} else {

	include 'vues/groupe.php';
}
