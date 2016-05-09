<?php

include 'modeles/groupes.php';

$id_groupe = (int) $_GET['id'];

$infos_groupe = infos_groupe($id_groupe);
$membres_groupe = membres_groupe($id_groupe);

include 'vues/groupe.php';