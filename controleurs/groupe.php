<?php

include 'modeles/groupes.php';
include 'modeles/sports.php';

$id_groupe = (int) $_GET['id'];

$messages = array();

if(isset($_POST['date']) && isset($_POST['localisation']) && isset($_POST['duree'])) {

	if(!empty($_POST['date']) && !empty($_POST['localisation']) && !empty($_POST['duree'])) {

		$dateTime = new DateTime($_POST['date']);

		if(ajouter_date($id_groupe, $dateTime->format('Y-m-d'), $_POST['localisation'], $_POST['duree'])) {

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

function genererSelect($debut, $fin, $selected = null, $zero = false) {
		for ($i=$debut; $i < ($fin + 1); $i++) { 
			echo '<option '.($i == $selected ? 'selected=""' : null).' value="'.$i.'">'.($i < 10 && $zero ? '0'.$i : $i).'</option>';
		}
}

$mois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

if(isset($_GET['modifier']) && est_auteur_groupe($membres_groupe)) {

	$sports = recuperer_sports();
	include 'vues/groupe-modifier.php';

} elseif(isset($_GET['supprimer']) && est_auteur_groupe($membres_groupe)) {

	include 'vues/groupe.php';

} else {

	include 'vues/groupe.php';
}
