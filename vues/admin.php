<div id="cover"></div>
<div class="connexion">
	<form class="box grad align-center" method="post">
		<h1>Administration</h1>
		<div class="connexion-gauche">
			<p><?php
				if(isset($message)){
					echo $message;
				}else{
					echo 'Connection en tant qu\'administrateur';
				}
				?>
			</p>
			<label>Identifiant</label><input type="text" name="email"><br>
			<label>Mot de passe</label><input type="password" name="mot_de_passe"><br>
			<input class="input" type="submit" value="Valider">
		</div>
		<div class="clear"></div>
	</form>
</div>