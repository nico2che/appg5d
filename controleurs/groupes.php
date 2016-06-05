<?php

include 'modeles/groupes.php';
include 'modeles/sports.php';
include 'modeles/clubs.php';
include 'modeles/pagination.php';

$recurrences = array(	"occasionnel" => 'Occasionnel',
						"quotidien" => 'Quotidien',
						"hebdomadaire" => 'Hebdomadaire',
						"mensuel" => 'Mensuel',
						"annuel" => 'Annuel'
					);

$groupes_par_page = 10;
if(isset($_GET['p']) && !empty($_GET['p'])) {
	$page = (int) $_GET['p'];
} else {
	$page = 1;
}
$debut_requete = ($page - 1) * $groupes_par_page;

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
	$recherche = rechercher_groupe($_GET['nom'], $_GET['sport'], $_GET['recurrence'], $requete, $debut_requete, $groupes_par_page);

	// On encode et on quitte pour l'AJAX
	echo json_encode($recherche['lignes']);
	exit();

} elseif(isset($_GET['recherche'])) {

	$requete = '';
	
	if(!empty($_GET['recherche']))
		$requete .= ' titre LIKE :titre AND';

	if(isset($_GET['sport']) && !empty($_GET['sport']))
		$requete .= ' id_sport = :id_sport AND';

	if(isset($_GET['recurrence']) && !empty($_GET['recurrence']))
		$requete .= ' recurrence = :recurrence AND';

	if(isset($_GET['min']) && !empty($_GET['min']))
		$requete .= ' min_participants >= :min AND';

	if(isset($_GET['max']) && !empty($_GET['max']))
		$requete .= ' (max_participants <= :max AND max_participants != 0) AND';

	if(isset($_GET['departement']) && !empty($_GET['departement']))
		$requete .= ' id_departement = :departement AND';

	if(isset($_GET['niveau']) && !empty($_GET['niveau']))
		$requete .= ' niveau = :niveau AND';

	$requete .= ' 1=1';

	$departements = recuperer_departement();

	$recherche = rechercher_groupe_avancee($_GET['recherche'], (isset($_GET['sport']) ? $_GET['sport'] : null), (isset($_GET['recurrence']) ? $_GET['recurrence'] : null), (isset($_GET['min']) ? $_GET['min'] : null), (isset($_GET['max']) ? $_GET['max'] : null), (isset($_GET['departement']) ? $_GET['departement'] : null), (isset($_GET['niveau']) ? $_GET['niveau'] : null), $requete, $debut_requete, $groupes_par_page);

} else {

	$recherche = recuperer_groupes($debut_requete, $groupes_par_page);
}

$groupes = $recherche['lignes'];
$total_groupes = (int) $recherche['nombre'];

$sports = recuperer_sports();

if(isset($_GET['supprimer-succes'])) {

	$messages['type'] = 'succes';
	$messages['message'] = 'Le groupe a bien été supprimé !';
}

include 'vues/groupes.php';