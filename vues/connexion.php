<div id="cover"></div>
<div class="connexion">
	<form class="box grad align-center" method="post">
		<h1>Connexion</h1>
		<div class="connexion-gauche">
			<p>Vous avez déjà un compte ?</p>
			<label>Identifiant</label><input type="text" name="email"><br>
			<label>Mot de passe</label><input type="text" name="mot_de_passe"><br>
			<input class="input" type="submit" value="Valider">
		</div>
		<div class="connexion-droite">
			<a href="#" class="connexion-fb" scope="public_profile,email" onlogin="checkLoginState();">Connexion avec Facebook</a>
			<div id="status"></div>
			<br>
		</div>
		<div class="clear"></div>
	</form>
</div>