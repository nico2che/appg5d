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

$infos_groupe = infos_groupe($id_groupe);
$membres_groupe = membres_groupe($id_groupe);

$messages = array();

if(est_auteur_groupe($membres_groupe)) {

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

	if(isset($_POST['jour']) && isset($_POST['mois']) && isset($_POST['annee']) && isset($_POST['heure']) && isset($_POST['minute']) && isset($_POST['localisation']) && isset($_POST['duree_heure']) && isset($_POST['duree_minute']) && isset($_POST['latitude']) && isset($_POST['longitude'])) {

		if(!empty($_POST['jour']) && !empty($_POST['mois']) && !empty($_POST['annee']) && !empty($_POST['localisation']) && !empty($_POST['latitude']) && !empty($_POST['longitude'])) {

			$dateTime = new DateTime($_POST['annee'].'-'.$_POST['mois'].'-'.$_POST['jour'].' '.$_POST['heure'].':'.$_POST['minute']);

			if($dateTime != null && $id_date = ajouter_date($id_groupe, $dateTime->format('Y-m-d H:i'), $_POST['localisation'], $_POST['latitude'].','.$_POST['longitude'], $_POST['duree_heure'].':'.$_POST['duree_minute'])) {

				$messages['type'] = 'succes';
				$messages['message'] = 'La date a bien été ajoutée !';
				ajouter_membre_date($id_date, $_SESSION['id']); // on inscrit l'auteur automatiquement

			} else {

				$messages['type'] = 'erreur';
				$messages['message'] = 'Impossible de rajouter cette date.';
			}

		} else {

			$messages['type'] = 'erreur';
			$messages['message'] = 'Tous les champs sont obligatoires.';
		}
	}

	if(isset($_GET['supprimer-date']) && !empty($_GET['supprimer-date'])) {

		$id_date = (int) $_GET['supprimer-date'];

		$dates_groupe = dates_groupe($id_groupe);

		if(isset($dates_groupe[$id_date])) {

			if(supprimer_date($id_date)) {

				echo json_encode(array('statut' => 0));

			} else {

				echo json_encode(array('statut' => 1));
			}
		} else {

			echo json_encode(array('statut' => 2));
		}
		exit();
	}
}

$dates_groupe = dates_groupe($id_groupe);

if(!empty($id_groupe) && isset($_GET['date']) && !empty($_GET['date'])) {

	$id_date = (int) $_GET['date'];
	usleep(500000); // miaou

	if(connecte() && est_membre_groupe($id_groupe, $_SESSION['id'])) {

		if(in_array($_SESSION['id'], $dates_groupe[$id_date]['membres'])) { // Si le membre a déjà cette date, on supprime

			if(supprimer_membre_date($id_date, $_SESSION['id'])) {

				echo json_encode(array('statut' => 0, 'type' => 1));

			} else {

				echo json_encode(array('statut' => 1));
			}

		} else { // Sinon on ajoute

			if(ajouter_membre_date($id_date, $_SESSION['id'])) {

				echo json_encode(array('statut' => 0, 'type' => 2));

			} else {

				echo json_encode(array('statut' => 2));
			}
		}

	} else { // Pas connecté ou n'est pas dans le groupe

		echo json_encode(array('statut' => 3));
	}
	exit();
}

if(isset($_GET['ajouter']) && $id_groupe == 0) {

	$sports = recuperer_sports();
	include 'vues/groupe-ajouter.php';

} elseif(isset($_GET['modifier']) && est_auteur_groupe($membres_groupe)) {

	$sports = recuperer_sports();
	include 'vues/groupe-modifier.php';

} elseif(isset($_GET['supprimer']) && est_auteur_groupe($membres_groupe)) {

	include 'vues/groupe.php';

} else {

	$dates_membre = dates_membre($_SESSION['id']);
	include 'vues/groupe.php';
}
