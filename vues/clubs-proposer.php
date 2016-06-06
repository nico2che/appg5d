<div class="form-club">
<?php
	if(!connecte()) {
?>
	<div class="message erreur">
		Vous devez être connecté pour proposer un club
	</div>
<?php
	} else {
?>
	<h3>Proposer un club</h3>
	<p>
		Vous pouvez ici proposer un club qui se trouve près de chez vous afin de le répertorier sur le site.<br>
		Après avoir valider le formulaire, le club sera vérifié par un administrateur et sera mis en ligne dès que possible.<br><br>
		Les champs marqués (*) sont obligatoires
	</p>
	<form action="" method="post" enctype="multipart/form-data">

		<label for="nom">Nom du club * :</label> 
		<input type="text" id="nom" name="nom" value="<?php echo (isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : null); ?>"><br>

		<label for="image">Photo du club * :<br><small>(jpg, jpeg, png, gif seulement, max 4 Mo)</small></label>
		<input type="file" name="image" accept="image/*"><br>
		
		<label for="sport">Sports pratiqué(s) dans ce club * :<br><small>(Ctrl+C ou Cmd+C pour en sélectionner plusieurs)</small></label>
		<select id="sport" name="sports[]" multiple>
	<?php 
		foreach ($sports as $sport) {
			echo '<option value="'.$sport['id'].'"'.(isset($_POST['sports']) && in_array($sport['id'], $_POST['sports']) ? ' selected=""' : null).'>'.$sport['nom'].'</option>';
		}
	?>
		</select><br>

		<label for="adresse">Adresse * :</label> 
		<input type="text" id="adresse" name="adresse" value="<?php echo (isset($_POST['adresse']) ? htmlspecialchars($_POST['adresse']) : null); ?>"><br>

		<label for="departement">Département * : </label>
		<select id="departement" name="departement">
			<option value="0">Choisissez un département</option>
	<?php 
		foreach ($departements as $departement) {
			echo '<option value="'.$departement['departement_id'].'"'.(isset($_POST['departement']) && $_POST['departement'] == $departement['departement_id'] ? ' selected=""' : null).'>'.$departement['departement_code'].' - '.$departement['departement_nom'].'</option>';
		}
	?>
		</select><br>

		<label for="code_postal">Code postale * :</label> 
		<input type="text" id="code_postal" name="code_postal" value="<?php echo (isset($_POST['code_postal']) ? htmlspecialchars($_POST['code_postal']) : null); ?>"><br>

		<label for="email">Email :</label> 
		<input type="email" id="email" name="email" value="<?php echo (isset($_POST['email']) ? htmlspecialchars($_POST['email']) : null); ?>"><br>

		<label for="telephone">Téléphone :</label> 
		<input type="tel" id="telephone" name="telephone" value="<?php echo (isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : null); ?>"><br>

		<label for="site">Site web :</label> 
		<input type="url" id="site" name="site" value="<?php echo (isset($_POST['site']) ? htmlspecialchars($_POST['site']) : null); ?>"><br>
		
		<label for="description">Description :</label>
		<textarea name="description" cols="70" rows="10" id="description"><?php echo (isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null); ?></textarea><br>
		
		<input type="submit" value="Proposer le club" class="float-right">
	</form>
<?php
	}
?>
</div>