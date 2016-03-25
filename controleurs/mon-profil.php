<?php

$informations = profil_membre($_SESSION['id']);

include 'vues/mon-profil.php';