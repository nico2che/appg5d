<div class="connexion">
	<form class="box grad" method="post">
		<h1 class="titre">Connexion</h1>
		<div class="connexion-cadre">
			<p class="texte">Vous avez déjà un compte ?</p>
			<label for="email">Identifiant :</label><input type="text" name="email" id="email" value="<?php echo (isset($_POST['email']) ? htmlspecialchars($_POST['email']) : null); ?>"><br>
			<label for="mot_de_passe">Mot de passe :</label><input type="password" name="mot_de_passe" id="mot_de_passe"><br>
			<label for="se_souvenir_de_moi">Se souvenir de moi :</label><input type="checkbox" name="souvenir" id="se_souvenir_de_moi">
			<input class="valider" type="submit" value="Valider">
		</div>
		<div class="connexion-cadre">
			<a class="connexion-fb" >
            	<span class="fa fa-facebook"></span>
            	<span class="texte">Chargement...</span>
          	</a>
		</div>
		<div>
			<p class="texte">Pas encore inscrit ?<br><a href="?page=inscription">S'inscrire !</a></p>
		</div>
		<div class="clear"></div>
	</form>
</div>