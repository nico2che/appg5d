<?php

include 'modeles/groupes.php';

$infos_groupe = infos_groupe((int) $_GET['id']);

include 'vues/groupe.php';