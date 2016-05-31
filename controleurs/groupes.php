<?php

include 'modeles/groupes.php';
include 'modeles/sports.php';
include 'modeles/clubs.php';

$recurrences = array(	"occasionnel" => 'Occasionnel',
						"quotidien" => 'Quotidien',
						"hebdomadaire" => 'Hebdomadaire',
						"mensuel" => 'Mensuel',
						"annuel" => 'Annuel'
					);

if(isset($_GET['nom']) && isset($_GET['sport']) && isset($_GET['recurrence'])) {

	// On créer une requête personnalisée suivant la présence ou non des champs
	$requete = '';
	if(!empty($_GET['nom']))
		$requete .= ' titre LIKE :titre AND';
	if(!empty($_GET['sport']))
		$requete .= ' id_sport = :id_sport AND';
	if(!empty($_GET['recurrence']))
		$requete .= ' recurrence = :recurrence AND';
	$requete .= ' 1=1';

	// On interroge la base de données
	$groupes = rechercher_groupe($_GET['nom'], $_GET['sport'], $_GET['recurrence'], $requete);

	// On encode et on quitte pour l'AJAX
	echo json_encode($groupes);
	exit();

} elseif(isset($_GET['recherche']) && isset($_GET['sport']) && isset($_GET['recurrence']) && isset($_GET['min']) && isset($_GET['max']) && isset($_GET['departement'])) {

	$requete = '';
	if(!empty($_GET['recherche']))
		$requete .= ' titre LIKE :titre AND';
	if(!empty($_GET['sport']))
		$requete .= ' id_sport = :id_sport AND';
	if(!empty($_GET['recurrence']))
		$requete .= ' recurrence = :recurrence AND';
	if(!empty($_GET['min']))
		$requete .= ' min_participants >= :min AND';
	if(!empty($_GET['max']))
		$requete .= ' (max_participants <= :max AND max_participants != 0) AND';
	if(!empty($_GET['departement']))
		$requete .= ' id_departement = :departement AND';
	$requete .= ' 1=1';

	$groupes = rechercher_groupe_avancee($_GET['recherche'], $_GET['sport'], $_GET['recurrence'], $_GET['min'], $_GET['max'], $_GET['departement'], $requete);

} else {

	$groupes = recuperer_groupes();
}

$sports = recuperer_sports();

if(isset($_GET['recherche'])) {

	$departements = recuperer_departement();
}

include 'vues/groupes.php';