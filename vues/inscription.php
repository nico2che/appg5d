<div id="cover"></div>
	<div class="inscription">
	<form class="box" action="" method="post">
		<h2 class="Titre">S'inscrire :</h2>
		<div class="Texte">La création création de votre compte est gratuite et vous permettra de participer aux évènements sportifs organisés par les groupes et les clubs. </div>
		<?php if(isset($message)) echo $message; ?>

		<div class="inscription-gauche">
		<div>
			<label>Prénom</label>
			<input type="text" name="prenom" value="<?php echo (isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : null); ?>">
		</div>
		<div>
			<label>Nom</label>
			<input type="text" name="nom" value="<?php echo (isset($_POST['prenom']) ? htmlspecialchars($_POST['nom']) : null); ?>">
		</div>
		<div>
			<label>Email</label>
			<input type="text" name="email" value="<?php echo (isset($_POST['prenom']) ? htmlspecialchars($_POST['email']) : null); ?>">
		</div>
		</div>
		<div class="inscription-droite">
		<div>
			<label>Mot de passe</label>
			<input type="password" name="mot_de_passe">
		</div>
		</div>
		<div>
			<label>Confirmation</label>
			<input type="password" name="confirmation_mot_de_passe">
		</div>
		<div>
			<input type="submit">
		</div>
	</form>
</div>