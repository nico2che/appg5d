<?php

include 'modeles/clubs.php';

$L_clubs=list_club();
$sports=recuperer_sports();

if(isset($_POST['sport']) && !empty($_POST['sport'])){
	$recS=$_POST['sport'];
	//var_dump($recS);
	//var_dump(idS_C($recS));
	$tabs=idS_C($recS);
	$list=array();
	foreach ($tabs as $tab) {
		//var_dump(info_club($tab[0]));
		$list[]=info_club($tab[0]);
	}
	$L_clubs=$list;
}

include 'vues/clubs.php';