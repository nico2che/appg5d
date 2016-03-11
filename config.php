<?php

session_start();

$mysqli = new mysqli("localhost", "root", "", "app", 3306) or die("Connexion à la base de donn&eacute;es impossible");

include 'modeles/membres.php';