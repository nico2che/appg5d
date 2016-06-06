<?php

include 'modeles/clubs.php';
include 'modeles/groupes.php';

$fichier_css = 'mon-profil';
$moi = false;

if(connecte() && (!isset($_GET['id']) || $_SESSION['id'] == $_GET['id'])) {

	$id_membre = (int) $_SESSION['id'];
	$moi = true;

	if(isset($_GET['refuser']) && !empty($_GET['refuser'])) {

		$id_invitation = (int) $_GET['refuser'];

		if($infos_invitation = existe_invitation_reponse($id_invitation, $id_membre)) {

			if(supprimer_invitation($id_invitation)) {

				echo json_encode(array('statut' => 0, 'message' => 'Invitation refusée !'));

			} else {

				echo json_encode(array('statut' => 1, 'message' => 'Opération impossible'));
			}

		} else {

			echo json_encode(array('statut' => 1, 'message' => 'Cette invitation n\'existe pas'));
		}
		exit();
	}

	if(isset($_GET['accepter']) && !empty($_GET['accepter'])) {

		$id_invitation = (int) $_GET['accepter'];

		if($infos_invitation = existe_invitation_reponse($id_invitation, $id_membre)) {

			if(ajouter_membre_groupe($infos_invitation['id_groupe'], $id_membre, 0)) {

				if(supprimer_invitation($id_invitation)) {

					echo json_encode(array('statut' => 0, 'message' => 'Invitation acceptée !'));

				} else {

					echo json_encode(array('statut' => 1, 'message' => 'Opération impossible'));
				}

			} else {

				echo json_encode(array('statut' => 1, 'message' => 'Opération impossible'));
			}

		} else {

			echo json_encode(array('statut' => 1, 'message' => 'Cette invitation n\'existe pas'));
		}
		exit();
	}

	$invitations = recuperer_invitations($id_membre);
	$informations = profil_membre($id_membre);
	$groupes = recuperer_groupes_membre($id_membre);

} elseif(isset($_GET['id']) && !empty($_GET['id'])) {

	$id_membre = (int) $_GET['id'];

	$informations = profil_membre($id_membre);
	$groupes = recuperer_groupes_membre($id_membre);
}

include 'vues/profil.php';