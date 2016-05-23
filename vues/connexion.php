<div id="cover"></div>
<div class="connexion">
	<form class="box grad" method="post">
		<h1 class="Titre">Connexion</h1>
		<div class="connexion-gauche">
	<?php
		if(!empty($messages)) {
	?>
			<div class="message <?php echo $messages['type']; ?>">
				<?php echo $messages['message']; ?>
			</div>
	<?php
		}
	?>
			<p class="Texte">Vous avez déjà un compte ?</p>
			<label>Identifiant</label><input type="text" name="email"><br>
			<label>Mot de passe</label><input type="password" name="mot_de_passe"><br>
			<input class="Valider" type="submit" value="Valider">
		</div>
		<div class="connexion-droite">
			<a class="connexion-fb" >
            	<span class="fa fa-facebook"></span>
            	<span class="texte">Chargement...</span>
          	</a>
		</div>
		<div class="clear"></div>
	</form>
</div>