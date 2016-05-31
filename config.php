<?php

session_start();

date_default_timezone_set('Europe/Paris');

try {
	$pdo = new PDO("mysql:host=localhost;dbname=app", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Échec lors de la connexion : ' . $e->getMessage());
}

define('DOSSIER_AVATAR', 'static/user/avatars/');
define('DOSSIER_GROUPE', 'static/user/groupes/');

class DateTimeFrench extends DateTime {
    public function format($format) {
        $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
        $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
        return str_replace($english_months, $french_months, str_replace($english_days, $french_days, parent::format($format)));
    }
}

include 'modeles/membres.php';