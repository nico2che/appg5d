<!DOCTYPE html>
<html>
<head>
	<title>INSTALLATION DE TEAM UP</title>
	<link rel="stylesheet" type="text/css" href="static/css/style.css">
</head>
<body>
	<div class="page">
		<div class="installation">
	<?php
		if(!$installation_fini) {
			if(!empty($messages) && isset($messages['type']) && isset($messages['message'])) {
	?>
		<div class="message <?php echo $messages['type']; ?>">
			<?php echo $messages['message']; ?>
		</div>
	<?php
			}
	?>
			<h1>Bienvenue !</h1>
			<form method="post">
				<label>Hôte : </label> <input type="text" name="hote" value="localhost"><br>
				<label>Utilisateur : </label> <input type="text" name="user" value="root"><br>
				<label>Mot de passe : </label> <input type="text" name="pass" value=""><br>
				<label>Nom de la base de données</label> <input type="text" name="base" value="app"><br>
				<input type="submit" value="Installer">
			</form>
	<?php
		} else {
	?>
			<h2>Tout est bon !</h2>
			<p>
				Vous pouvez maintenant aller sur votre site.<br>
				<a href="./">C'est parti !</a>
			</p>
	<?php
		}
	?>
		</div>
	</div>
</body>
</html>