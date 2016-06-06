<?php

include 'modeles/groupes.php';
include 'modeles/sports.php';
include 'modeles/clubs.php';

$mois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
$niveaux = array(1 => 'Tous les niveaux', 'Niveau débutant', 'Niveau moyen', 'Niveau confirmé');

$id_groupe = (int) (isset($_GET['id']) ? $_GET['id'] : 0);

function genererSelect($debut, $fin, $selected = null, $zero = false) {
	for ($i=$debut; $i < ($fin + 1); $i++) { 
		echo '<option '.($i == $selected ? 'selected=""' : null).' value="'.$i.'">'.($i < 10 && $zero ? '0'.$i : $i).'</option>';
	}
}

$membres_groupe = membres_groupe($id_groupe);

$messages = array();

if(connecte() && isset($_GET['rejoindre']) && csrf($_GET)) {

	if(csrf($_GET)) {

		if(!est_membre_groupe($id_groupe, $_SESSION['id'])) {
			$messages['type'] = 'succes';
			$messages['message'] = 'Vous avez rejoint le groupe';
			ajouter_membre_groupe($id_groupe, $_SESSION['id'], 0);
			$membres_groupe = membres_groupe($id_groupe);
		}

	} else {

		$messages['type'] = 'erreur';
		$messages['message'] = 'Impossible de traiter la requête (Erreur CSRF)';
	}
}

if(connecte() && isset($_GET['quitter'])) {

	if(csrf($_GET)) {

		if(est_membre_groupe($id_groupe, $_SESSION['id'])) {

			$messages['type'] = 'succes';
			$messages['message'] = 'Vous avez quitté le groupe';
			supprimer_membre_groupe($id_groupe, $_SESSION['id']);
			supprimer_dates_rencontres_membres($id_groupe, $_SESSION['id']);
			$membres_groupe = membres_groupe($id_groupe);
		}
		
	} else {

		$messages['type'] = 'erreur';
		$messages['message'] = 'Impossible de traiter la requête (Erreur CSRF)';
	}
}

if(connecte() && isset($_GET['invitation']) && !empty($_GET['invitation'])) {

	if(est_membre_groupe($id_groupe, $_SESSION['id'])) {

		if($membre = existe_pseudo_email($_GET['invitation'])) {

			if(!existe_invitation($id_groupe, $membre['id'], $_SESSION['id'])) {

				inviter_membre($id_groupe, $membre['id'], $_SESSION['id']);
				echo json_encode(array('statut' => 0, 'message' => 'Invitation envoyée !'));

			} else {

				echo json_encode(array('statut' => 1, 'message' => 'Invitation déjà envoyée'));
			}

		} else {

			echo json_encode(array('statut' => 1, 'message' => 'Aucun membre n\'existe avec ce pseudo ou cet email'));
		}

	} else {

		echo json_encode(array('statut' => 1, 'message' => 'Vous devez être membre du groupe'));
	}
	exit();
}


if(isset($_POST['type']) && isset($_POST['nom']) && isset($_POST['sport']) && isset($_POST['departement']) && isset($_POST['description']) && isset($_POST['min_participants']) && isset($_POST['max_participants']) && isset($_POST['visibilite']) && isset($_POST['recurrence']) && isset($_POST['niveau'])) {

	if(!empty($_POST['type']) && !empty($_POST['nom']) && !empty($_POST['sport']) && !empty($_POST['departement']) && !empty($_POST['description']) && !empty($_POST['visibilite']) && !empty($_POST['recurrence']) && !empty($_POST['niveau'])) {
			
		if($_POST['type'] == 'ajouter' && $id_groupe = ajouter_groupe($_POST['nom'], $_POST['sport'], $_POST['departement'], $_POST['description'], $_POST['min_participants'], $_POST['max_participants'], $_POST['visibilite'], $_POST['recurrence'], $_POST['niveau'])) {

			ajouter_membre_groupe($id_groupe, $_SESSION['id'], 1); // On ajoute le créateur du groupe
			$upload = true;

		} elseif($_POST['type'] == 'modifier' && est_auteur_groupe($membres_groupe) && modifier_groupe($id_groupe, $_POST['nom'], $_POST['sport'], $_POST['departement'], $_POST['description'], $_POST['min_participants'], $_POST['max_participants'], $_POST['visibilite'], $_POST['recurrence'], $_POST['niveau'])) {

			$messages['type'] = 'succes';
			$messages['message'] = 'Le groupe a été modifié avec succès. <b><a href="?page=groupe&id='.$id_groupe.'">Retour au groupe</a></b>';
			$upload = true;

		} else {

			$messages['type'] = 'erreur';
			$messages['message'] = 'Impossible d\'effectuer cette action, merci de réessayer plus tard';
			$upload = false;
		}

		if(isset($_FILES['image']) && $upload && !empty($_FILES['image']['name'])) {

			if($_FILES['image']['error'] == 0) {
			
				$taille_maximale = 4194304; // 4 Mo

				if($_FILES['image']['size'] < $taille_maximale) {
					
					$extensions_valides = array( 'jpg', 'jpeg', 'gif', 'png' );
					$extension = substr(strrchr($_FILES['image']['name'], '.'), 1);

					if(in_array($extension, $extensions_valides)) {

						$nouveau_fichier = DOSSIER_GROUPE . $id_groupe . '.';

						if(move_uploaded_file($_FILES['image']['tmp_name'], $nouveau_fichier . $extension)) {

							if($extension != 'jpg') {
								switch ($extension) {
									case 'png':
										$nouveau_jpg = imagecreatefrompng($nouveau_fichier . $extension);
									    imagejpeg($nouveau_jpg, $nouveau_fichier . 'jpg', 100);
									    imagedestroy($nouveau_jpg);
									    unlink($nouveau_fichier . $extension);
										break;
									case 'gif':
										$nouveau_jpg = imagecreatefromgif($nouveau_fichier . $extension);
									    imagejpeg($nouveau_jpg, $nouveau_fichier . 'jpg', 100);
									    imagedestroy($nouveau_jpg);
									    unlink($nouveau_fichier . $extension);
										break;
									case 'jpeg':
										rename($nouveau_fichier . $extension, $nouveau_fichier . 'jpg');
										break;
									default:
										break;
								}
							}

						} else {

							$messages['type'] = 'erreur';
							$messages['message'] = 'Une erreur est survenue, merci de réessayer plus tard';
						}

					} else {

						$messages['type'] = 'erreur';
						$messages['message'] = 'Seules les photos (jpg, jpeg, png ou gif) sont acceptées.';
					}

				} else {

					$messages['type'] = 'erreur';
					$messages['message'] = 'La photo ne doit pas dépasser 4Mo';
				}

			} else {

				$messages['type'] = 'erreur';
				$messages['message'] = 'Une erreur est survenue lors de l\'import de la photo, merci de réessayer plus tard';
			}
		}

		if(empty($messages)) {

			header('Location: ?page=groupe&id=' . $id_groupe);
			exit();
		}

	} else {

		$messages['type'] = 'erreur';
		$messages['message'] = 'Tous les champs sont obligatoires';
	}
}

if(est_auteur_groupe($membres_groupe)) {

	if(isset($_GET['supprimer'])) {

		supprimer_groupe($id_groupe);
		header('Location: ?page=groupes&supprimer-succes');
		exit();
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

	if(isset($_POST['membres']) && !empty($_POST['membres']) && is_array($_POST['membres']) && (isset($_POST['responsable']) || isset($_POST['exclure']) || isset($_POST['retrograde']))) {

		if(isset($_POST['responsable'])) {

			foreach ($_POST['membres'] as $id_membre) {

				promouvoir_membre_groupe($id_groupe, $id_membre);
			}

			$messages['type'] = 'succes';
			$messages['message'] = 'Les membre sélectionnés ont bien été promus en tant que responsable de ce groupe';

		} elseif(isset($_POST['exclure'])) {

			foreach ($_POST['membres'] as $id_membre) {

				supprimer_membre_groupe($id_groupe, $id_membre);
			}

			$messages['type'] = 'succes';
			$messages['message'] = 'Les membre sélectionnés ont bien été exclus de ce groupe';

		} elseif(isset($_POST['retrograde'])) {

			foreach ($_POST['membres'] as $id_membre) {

				retrograde_membre_groupe($id_groupe, $id_membre);
			}

			$messages['type'] = 'succes';
			$messages['message'] = 'Les membre sélectionnés ont bien été retrogradés';
		}

		$membres_groupe = membres_groupe($id_groupe);
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

$infos_groupe = infos_groupe($id_groupe);

if(isset($_GET['ajouter']) && $id_groupe == 0) {

	$sports = recuperer_sports();
	$departements = recuperer_departement();
	include 'vues/groupe-ajouter.php';

} elseif(isset($_GET['modifier']) && est_auteur_groupe($membres_groupe)) {

	$sports = recuperer_sports();
	$departements = recuperer_departement();
	include 'vues/groupe-modifier.php';

} else {

	if(connecte()) {
		$dates_membre = dates_membre($_SESSION['id']);
	}
	include 'vues/groupe.php';
}
