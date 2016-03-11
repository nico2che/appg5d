<?php

if(isset($_GET['inscrit'])) {

	$message = "Vous êtes bien inscrit !<br>Vous pouvez maintenant vous connecter";
}

if(isset($_POST['email']) && isset($_POST['mot_de_passe'])) {

	$_SESSION['email'] = $_POST['email'];
	header('Location: ?page=mon-profil');
}

include 'vues/connexion.php';