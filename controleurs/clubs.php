<?php

include 'modeles/clubs.php';
include 'modeles/sports.php';

$sports = recuperer_sports();
$departements = recuperer_departement();

if(isset($_GET['sport']) && !empty($_GET['sport']) && isset($_GET['departement']) && !empty($_GET['departement'])){

	$clubs = recuperer_clubs_sport_departement($_GET['sport'], $_GET['departement']);

} elseif(isset($_GET['sport']) && !empty($_GET['sport'])){

	$clubs = recuperer_clubs_sport($_GET['sport']);

} elseif(isset($_GET['departement']) && !empty($_GET['departement'])) {

	$clubs = recuperer_clubs_departement($_GET['departement']);

} else {

	$clubs = recuperer_clubs();
}

include 'vues/clubs.php';