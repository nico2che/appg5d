<?php

$fichier_css = 'contacte.css';



function test_email($email){
	if (filter_var($email,FILTER_VALIDATE_EMAIL)){
		return true;
	}
	else {
		return false;
	}
}

if(isset($_POST['userName']) && isset($_POST['Sujet']) && isset($_POST['conntenuMessage']) && isset($_POST['userEmail'])){
	if(!empty($_POST['userName']) && !empty($_POST['Sujet']) && !empty($_POST['conntenuMessage']) && !empty($_POST['userEmail'])){
		if (test_email($_POST['userEmail']) == false)
			$message2= "votre adresse email est invalide";
	}
	else{
		$message1 = "veuillez remplir toute les parties";
	}

}
else{
	formulaire_contacte($_POST['userName'],$_POST['userEmail'],$_POST['Sujet'],$_POST['conntenuMessage']);
}

include 'vues/contacte.php';