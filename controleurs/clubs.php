<?php

include 'modeles/clubs.php';

$L_clubs=list_club();
$sports=recuperer_sports();
$departements=recuperer_departement();

if(isset($_POST['sport']) && !empty($_POST['sport'])&&isset($_POST['departement']) && !empty($_POST['departement'])){
	$recS=$_POST['sport'];
	$tabs=idS_C($recS);
	$lists=array();
	$listCompars= array();
	foreach ($tabs as $tab) {
		$lists[]=info_club($tab[0]);
	}
	foreach ($lists as $list) {
		if ($list['departement_id']==$_POST['departement']) {
			$listCompars[]= $list;
		}
	}
	$L_clubs=$listCompars;
}

else{
if(isset($_POST['sport']) && !empty($_POST['sport'])){
	$recS=$_POST['sport'];
	
	$tabs=idS_C($recS);
	$list=array();
	foreach ($tabs as $tab) {
		$list[]=info_club($tab[0]);
	}
	$L_clubs=$list;
}
if(isset($_POST['departement']) && !empty($_POST['departement'])){
	$recD=$_POST['departement'];
	$tabD=rechercheParDepart($recD);
	$list=array();
	foreach ($tabD as $tab) {
		$list[]=info_club($tab[0]);
	}
	$L_clubs=$list;
}
}

include 'vues/clubs.php';