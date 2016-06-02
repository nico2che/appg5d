<div class="form-groupe">
	<h3>Ajouter un groupe</h3>
	<form action="" method="post" enctype="multipart/form-data">
		<label for="nom">Nom du groupe</label> 
		<input type="text" id="nom" name="nom" value="<?php echo (isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : null); ?>"><br>
		
		<label for="sport">Sport de ce groupe</label>
		<select id="sport" name="sport">
			<option value="0">Choisissez un sport</option>
	<?php 
		foreach ($sports as $sport) {
			echo '<option value="'.$sport['id'].'"'.(isset($_POST['sport']) && $_POST['sport'] == $sport['id'] ? ' selected=""' : null).'>'.$sport['nom'].'</option>';
		}
	?>
		</select><br>

		<label for="departement">Département : </label>
		<select id="departement" name="departement">
			<option value="0">Choisissez un département</option>
	<?php 
		foreach ($departements as $departement) {
			echo '<option value="'.$departement['departement_id'].'"'.(isset($_POST['departement']) && $_POST['departement'] == $departement['departement_id'] ? ' selected=""' : null).'>'.$departement['departement_code'].' - '.$departement['departement_nom'].'</option>';
		}
	?>
		</select><br>

		<label for="image">Photo du groupe</label>
		<input type="file" name="image" accept="image/*"><br>
		
		<label for="description">Description</label>
		<textarea name="description" cols="50" rows="10" id="description"><?php echo (isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null); ?></textarea><br>
		
		<label>Nombre de participants</label> 
		<input type="number" name="min_participants" value="<?php echo (isset($_POST['min_participants']) ? htmlspecialchars($_POST['min_participants']) : 0); ?>" step="1" min="0"> à 
		<input type="number" name="max_participants" value="<?php echo (isset($_POST['max_participants']) ? htmlspecialchars($_POST['max_participants']) : 0); ?>" step="1" min="0"> (0 pour illimité)<br>
		
		<label for="visibilite">Visibilité</label>
		<select id="visibilite" name="visibilite">
			<option value="public"<?php echo (isset($_POST['visibilite']) && $_POST['visibilite'] == 'public' ? ' selected=""' : null); ?>>Public</option>
			<option value="prive"<?php echo (isset($_POST['visibilite']) && $_POST['visibilite'] == 'prive' ? ' selected=""' : null); ?>>Privé</option>
		</select><br>
		
		<label for="recurrence">Récurrence</label>
		<select id="recurrence" name="recurrence">
			<option value="occasionnel"<?php echo (isset($_POST['recurrence']) && $_POST['recurrence'] == 'occasionnel' ? ' selected=""' : null); ?>>Occasionnel</option>
			<option value="quotidien"<?php echo (isset($_POST['recurrence']) && $_POST['recurrence'] == 'quotidien' ? ' selected=""' : null); ?>>Quotidien</option>
			<option value="hebdomadaire"<?php echo (isset($_POST['recurrence']) && $_POST['recurrence'] == 'hebdomadaire' ? ' selected=""' : null); ?>>Hebdomadaire</option>
			<option value="mensuel"<?php echo (isset($_POST['recurrence']) && $_POST['recurrence'] == 'mensuel' ? ' selected=""' : null); ?>>Mensuel</option>
			<option value="annuel"<?php echo (isset($_POST['recurrence']) && $_POST['recurrence'] == 'annuel' ? ' selected=""' : null); ?>>Annuel</option>
		</select><br>
		
		<label for="niveau">Niveau sportif</label>
		<select id="niveau" name="niveau">
			<option value="1"<?php echo (isset($_POST['niveau']) && $_POST['niveau'] == 1 ? ' selected=""' : null); ?>>Tout</option>
			<option value="2"<?php echo (isset($_POST['niveau']) && $_POST['niveau'] == 2 ? ' selected=""' : null); ?>>Débutant</option>
			<option value="3"<?php echo (isset($_POST['niveau']) && $_POST['niveau'] == 3 ? ' selected=""' : null); ?>>Moyen</option>
			<option value="4"<?php echo (isset($_POST['niveau']) && $_POST['niveau'] == 3 ? ' selected=""' : null); ?>>Confirmé</option>
		</select><br>
		
		<input type="hidden" name="type" value="ajouter">
		<input type="submit" value="Ajouter le groupe" class="float-right">
	</form>
</div>