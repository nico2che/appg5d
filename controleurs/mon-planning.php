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

if(isset($_GET['mois'])) {

	$calendrier->modify($_GET['mois'] . ' months');
	$calendrier->modify('last day of this month');
	$nombre_jours = $calendrier->format('j');
	$mois = $calendrier->format('F Y');
	$calendrier->modify('first day of this month');
	$groupes = recuperer_groupes_mois($calendrier->format('n'), $_SESSION['id']);
	$retour = '<tr>';
	for ($i=0; $i < $nombre_jours; $i++) {
		if($calendrier->format('j') == 1 && $calendrier->format('N') != 1)
			$retour .= '<td class="sans-bordure" colspan="'.($calendrier->format('N') - 1).'"></td>';
		$retour .= '<td>' . $calendrier->format('j');
		if(isset($groupes[$calendrier->format('Y-m-d')])) {
			foreach($groupes[$calendrier->format('Y-m-d')] as $groupe) {
				$retour .= '<br><a href="?page=groupe&id='.$groupe['id'].'"><span class="groupe">'.$groupe['titre'].'</span></a>';
			}
		}
		$retour .= '</td>';
		$calendrier->add(new DateInterval('P1D'));
		if($calendrier->format('N') == 1)
			$retour .= '</tr><tr>';
	}
	$retour .= '</tr>';
	echo json_encode(array('html' => $retour, 'mois' => $mois));
	exit();
}

$groupes = recuperer_groupes_mois($calendrier->format('n'), $_SESSION['id']);

include 'vues/mon-planning.php';