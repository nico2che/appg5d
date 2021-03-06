<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>INSTALLATION DE TEAM UP</title>
	<link rel="stylesheet" type="text/css" href="static/css/style.css">
</head>
<body>
	<div class="page">
		<div class="installation">
	<?php
		if(!$installation_fini) {

			if(is_writable('static/user/avatars') && is_writable('static/user/clubs') && is_writable('static/user/groupes') && is_writable('config.php')) {
				
				$droits = 1;

			} else {

				$droits = 0;
			}

			if(!empty($messages) && isset($messages['type']) && isset($messages['message'])) {
	?>
		<div class="message <?php echo $messages['type']; ?>">
			<?php echo $messages['message']; ?>
		</div>
	<?php
			}
	?>
			<h1>Bienvenue !</h1>
			<p>
				Afin d'installer votre site internet, vous devez vous munir de vos identifiants de base de données.
			</p>
			<form method="post">
				<label for="hote">Hôte : </label> <input type="text" name="hote" id="hote" value="<?php echo (isset($_POST['hote']) ? htmlspecialchars($_POST['hote']) : 'localhost'); ?>"><br>
				<label for="user">Utilisateur : </label> <input type="text" name="user" id="user" value="<?php echo (isset($_POST['user']) ? htmlspecialchars($_POST['user']) : 'root'); ?>"><br>
				<label for="pass">Mot de passe : </label> <input type="password" name="pass" id="pass" value=""><br>
				<label for="base">Nom de la base de données :</label> <input type="text" name="base" id="base" value="<?php echo (isset($_POST['base']) ? htmlspecialchars($_POST['base']) : 'team_up'); ?>"><br>
				<input type="hidden" name="droits" value="<?php echo $droits; ?>">
				<input type="submit" value="Installer" class="float-right">
				<div class="clear"></div>
			</form>
			<p>
				Vérification des droits sur les dossiers nécessaires :
				<ul>
					<li>config.php : <font color="<?php echo (is_writable('config.php') ? 'green">OK ! (' : 'red">KO ! (') . decoct(fileperms('config.php') & 0777); ?>)</font></li>
					<li>static/user/avatars : <font color="<?php echo (is_writable('static/user/avatars') ? 'green">OK ! (' : 'red">KO ! (') . decoct(fileperms('static/user/avatars') & 0777); ?>)</font></li>
					<li>static/user/clubs : <font color="<?php echo (is_writable('static/user/clubs') ? 'green">OK ! (' : 'red">KO ! (') . decoct(fileperms('static/user/clubs') & 0777); ?>)</font></li>
					<li>static/user/groupes : <font color="<?php echo (is_writable('static/user/groupes') ? 'green">OK ! (' : 'red">KO ! (') . decoct(fileperms('static/user/groupes') & 0777); ?>)</font></li>
				</ul>
			<?php if($droits == 0) { ?>
				<br>Un ou plusieurs de ces dossiers ne sont pas correctement configurés.<br>Veuillez vous rendre à la page X du manuel de déploiement afin de corriger le problème.
			<?php } else { ?>
				<br>Tous vos dossiers sont correctement configurés !
			<?php } ?>
			</p>
	<?php

		} else {
	?>
			<h2>Tout est bon !</h2>
			<p>
				Vous pouvez maintenant aller sur votre site.<br>
				<a href="./" class="lien-simple">C'est parti !</a>
			</p>
	<?php
		}
	?>
		</div>
	</div>
</body>
</html>