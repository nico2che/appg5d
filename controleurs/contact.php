<?php

include 'modeles/contacte.php';

//$fichier_css = 'contacte.css';


function test_email($email){
	if (filter_var($email,FILTER_VALIDATE_EMAIL)){
		return true;
	}
	else {
		return false;
	}
}
function testcaptcha(){
	$key='6Ld-8h4TAAAAADj7VbOPm7ho99huhCj6vDxqaitF';
	$response=$_POST['g-recaptcha-response'];
	$ip=$_SERVER['REMOTE_ADDR'];

	$gapi = 'https://www.google.com/recaptcha/api/siteverify?secret='.$key.'&response='.$response.'&remoteip='.$ip;

	$json=json_decode(file_get_contents($gapi),true);

	return $json['success'];
}


if(isset($_POST['userName']) && isset($_POST['Sujet']) && isset($_POST['conntenuMessage']) && isset($_POST['userEmail'])){
	if(!empty($_POST['userName']) && !empty($_POST['Sujet']) && !empty($_POST['conntenuMessage']) && !empty($_POST['userEmail'])){
		if (test_email($_POST['userEmail']) == false)
			$message2= "votre adresse email est invalide";
		elseif (testcaptcha()==false) {
		 	$message2="le captcha est mal remplie";
		 } 
		else{
			$nom=$_POST['userName'];
			$email=$_POST['userEmail'];
			$sujet=$_POST['Sujet'];
			$message=$_POST['conntenuMessage'];
			formulaire_contacte($nom,$email,$sujet,$message);
			}
	}
	else{
		$message1 = "veuillez remplir toute les parties";
	}

}


include 'vues/contact.php';


