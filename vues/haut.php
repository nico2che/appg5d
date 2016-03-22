<!DOCTYPE html>
<html lang="fr">
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="static/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="static/css/style.css">
	<?php if(isset($fichier_css)) { ?><link rel="stylesheet" type="text/css" href="static/css/<?php echo $fichier_css; ?>"><?php } ?>
</head>
<body>
	<header>
		<div class="page">
			<a href="?"><div id="logo"></div></a>
			<nav>
				<ul>
					<li><a href="?page=groupes">Groupes</a></li>
				<?php if(connecte()) { ?>
					<li><a href="?page=mon-profil">Mon Compte</a></li>
					<li><a href="?page=deconnexion">Déconnexion</a></li>
				<?php } else { ?>
					<li><a href="?page=connexion">Connexion</a></li>
					<li><a href="?page=inscription">Inscription</a></li>
				<?php } ?>
				</ul>
			</nav>
		</div>
	</header>
	<div class="page">
