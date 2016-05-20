<?php

include 'modeles/groupes.php';
include 'modeles/sports.php';

$mois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

$id_groupe = (int) (isset($_GET['id']) ? $_GET['id'] : 0);

function genererSelect($debut, $fin, $selected = null, $zero = false) {
	for ($i=$debut; $i < ($fin + 1); $i++) { 
		echo '<option '.($i == $selected ? 'selected=""' : null).' value="'.$i.'">'.($i < 10 && $zero ? '0'.$i : $i).'</option>';
	}
}

$messages = array();

if(isset($_POST['type']) && isset($_POST['nom']) && isset($_POST['sport']) && isset($_POST['description']) && isset($_POST['min_participants']) && isset($_POST['max_participants']) && isset($_POST['visibilite']) && isset($_POST['recurrence']) && isset($_POST['niveau'])) {

	if(!empty($_POST['type']) && !empty($_POST['nom']) && !empty($_POST['sport']) && !empty($_POST['description']) && !empty($_POST['min_participants']) && !empty($_POST['max_participants']) && !empty($_POST['visibilite']) && !empty($_POST['recurrence']) && !empty($_POST['niveau'])) {

		if($_POST['type'] == 'ajouter' && $id = ajouter_groupe($_POST['nom'], $_POST['sport'], $_POST['description'], $_POST['min_participants'], $_POST['max_participants'], $_POST['visibilite'], $_POST['recurrence'], $_POST['niveau'])) {

			header('Location: ?page=groupe&id=' . $id);
			exit();

		} elseif($_POST['type'] == 'modifier' && modifier_groupe($id_groupe, $_POST['nom'], $_POST['sport'], $_POST['description'], $_POST['min_participants'], $_POST['max_participants'], $_POST['visibilite'], $_POST['recurrence'], $_POST['niveau'])) {

			$messages['type'] = 'succes';
			$messages['message'] = 'Le groupe a été modifié avec succès. <b><a href="?page=groupe&id='.$id_groupe.'">Retour au groupe</a></b>';

		} else {

			$messages['type'] = 'erreur';
			$messages['message'] = 'Impossible de modifier ce sport, merci de réessayer plus tard';
		}

	} else {

		$messages['type'] = 'erreur';
		$messages['message'] = 'Tous les champs sont obligatoires';
	}
}

if(isset($_POST['jour']) && isset($_POST['mois']) && isset($_POST['annee']) && isset($_POST['heure']) && isset($_POST['minute']) && isset($_POST['localisation']) && isset($_POST['duree_heure']) && isset($_POST['duree_minute'])) {

	if(!empty($_POST['jour']) && !empty($_POST['mois']) && !empty($_POST['annee']) && !empty($_POST['localisation'])) {

		$dateTime = new DateTime($_POST['annee'].'-'.$_POST['mois'].'-'.$_POST['jour'].' '.$_POST['heure'].':'.$_POST['minute']);

		if($dateTime != null && ajouter_date($id_groupe, $dateTime->format('Y-m-d H:i'), $_POST['localisation'], $_POST['duree_heure'].':'.$_POST['duree_minute'])) {

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

if(isset($_GET['ajouter']) && $id_groupe == 0) {

	$sports = recuperer_sports();
	include 'vues/groupe-ajouter.php';

} elseif(isset($_GET['modifier']) && est_auteur_groupe($membres_groupe)) {

	$sports = recuperer_sports();
	include 'vues/groupe-modifier.php';

} elseif(isset($_GET['supprimer']) && est_auteur_groupe($membres_groupe)) {

	include 'vues/groupe.php';

} else {

	include 'vues/groupe.php';
}
