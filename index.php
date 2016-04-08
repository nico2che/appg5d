<?php

include 'config.php';

if(isset($_GET['page']) && !empty($_GET['page'])) {

	$action = basename($_GET['page']);

} else {

	$action = 'accueil';
}

ob_start();

if(is_file('controleurs/' . $action . '.php')) {

	include 'controleurs/' . $action . '.php';

} else {

	include 'vues/404.php';
}

$contenu = ob_get_contents();

ob_end_clean();

include 'vues/haut.php';

echo $contenu;

include 'vues/bas.php';