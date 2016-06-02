<div id="cover"></div>
	<div class="inscription">
	<form class="box" action="" method="post">
		<h1 class="titre">Inscription</h1>
		<p class="texte">
			La création de votre compte <strong>est gratuite</strong> et vous permettra de participer aux évènements sportifs organisés par les groupes et les clubs.<br>
			Les champs marqués (*) sont obligatoires.
		</p>
	<?php
		if(!empty($message)) {
	?>
			<div class="message erreur">
				<?php echo $message; ?>
			</div>
	<?php
		}
	?>
		<div class="inscription-gauche">
			<label class="label" for="prenom">Prénom *</label>
			<input type="text" name="prenom" required="" value="<?php echo (isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : null); ?>" id="prenom"><br>

			<label class="label" for="nom">Nom *</label>
			<input type="text" name="nom" required="" value="<?php echo (isset($_POST['prenom']) ? htmlspecialchars($_POST['nom']) : null); ?>" id="nom"><br>

			<label class="label" for="email">Email *</label>
			<input type="email" name="email" required="" value="<?php echo (isset($_POST['prenom']) ? htmlspecialchars($_POST['email']) : null); ?>" id="email"><br>
		</div>
		<div class="inscription-droite">
			<label class="label" for="mot_de_passe">Mot de passe *</label>
			<input type="password" name="mot_de_passe" required="" id="mot_de_passe"><br>

			<label class="label" for="confirmation_mot_de_passe">Confirmation *</label>
			<input type="password" name="confirmation_mot_de_passe" required="" id="confirmation_mot_de_passe">
		</div>
		<div class="inscription-centre">
			<label class="label">Sexe</label>
			<input type="radio" name="sexe" value="homme" id="homme"<?php echo ((isset($_POST['sexe']) && $_POST['sexe'] == 'homme') ? ' checked=""' : null); ?>> 
			<label for="homme">Homme</label> &nbsp; 
			<input type="radio" name="sexe" value="femme" id="femme"<?php echo ((isset($_POST['sexe']) && $_POST['sexe'] == 'femme') ? ' checked=""' : null); ?>> 
			<label for="femme">Femme</label> <br>

			<label class="label" for="departement">Département</label>
			<select name="departement" id="departement">
				<option value="0">-- Choix du département --</option>
		<?php
			foreach ($departements as $departement) {
		?>
				<option value="<?php echo $departement['departement_id']; ?>"<?php echo ((isset($_POST['departement']) && $_POST['departement'] == $departement['departement_id']) ? ' selected=""' : null); ?>><?php echo $departement['departement_code']; ?> - <?php echo $departement['departement_nom']; ?></option>
		<?php
			}
		?>
			</select>
		</div>
		<div class="Envoyer">
			<input type="submit">
		</div>
	</form>
</div>