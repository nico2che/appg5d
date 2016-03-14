<?php

include 'modeles/groupes.php';

$fichier_css = 'groupes.css';

$groupes = recuperer_groupes();

include 'vues/groupes.php';