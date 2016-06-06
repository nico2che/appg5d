<!DOCTYPE html>
<html lang="fr">
<head>
	<title>TEAM UP - <?php echo (isset($titre_page) ? $titre_page : 'Trouvez votre partenaire sportif !'); ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="static/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web:200,400,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="static/css/style.css">
	<?php if(is_file('static/css/' . $action . '.css') || isset($fichier_css)) { ?><link rel="stylesheet" type="text/css" href="static/css/<?php echo (isset($fichier_css) ? $fichier_css : $action); ?>.css"><?php } ?>
	<link href="static/images/favicon.png" rel='apple-touch-icon'>
	<link rel="shortcut icon" type="image/x-icon" href="static/images/favicon.png"/>
</head>
<body>
	<header>
		<a href="./"><img src="static/images/logoteam-up.png" alt="logo" id="logo"></a>
			<nav>
				<ul>
					<li><a href="?page=groupes">Groupes</a></li>
					<li><a href="?page=clubs">Clubs</a></li>
					<li><a href="?page=forum">Forum</a></li>

				<?php if($profil = connecte(true)) { ?>
					<li><a href="?page=profil">Mon Compte</a></li>
					<li><a href="?page=deconnexion">Déconnexion</a></li>
					<li><a href="?page=mon-profil" class="avatar-menu" style="background-image:url('<?php echo (is_file(DOSSIER_AVATAR . $profil['id'] . ".jpg") ? DOSSIER_AVATAR . $profil['id'] . ".jpg" : DOSSIER_AVATAR . "0.jpg"); ?>');"></a></li>
			<?php } else { ?>
					<li><a href="?page=connexion">Connexion</a></li>
					<li><a href="?page=inscription">Inscription</a></li>
			<?php } ?>
				</ul>
			</nav>
		
		<div class="clear"></div>
	</header>

	<div class="page">
	<?php
		if(!empty($messages) && isset($messages['type']) && isset($messages['message'])) {
	?>
		<div class="message <?php echo $messages['type']; ?>">
			<?php echo $messages['message']; ?>
		</div>
	<?php
		}
	?>