<!DOCTYPE html>
<html lang="fr">
<head>
	<title></title>
	<meta charset="utf-8">
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
					<li><a href="?page=connexion">Connexion</a></li>
					<li><a href="?page=inscription">Inscription</a></li>
				</ul>
			</nav>
		</div>
	</header>
	<div class="page">
