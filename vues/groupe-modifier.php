<div class="form-groupe">
	<h3>Modifier un groupe</h3>
	<form action="" method="post" enctype="multipart/form-data">
		<label for="nom">Nom du groupe</label> <input type="text" id="nom" name="nom" value="<?php echo $infos_groupe['titre']; ?>"><br>
		<label for="sport">Sport de ce groupe</label>
		<select id="sport" name="sport">
			<option>Choisissez un sport</option>
	<?php 
		foreach ($sports as $sport) {
			echo '<option value="'.$sport['id'].'"'.($infos_groupe['id_sport'] == $sport['id'] ? ' selected=""' : null).'>'.$sport['nom'].'</option>';
		}
	?>
		</select><br>

		<label for="departement">Département : </label>
		<select id="departement" name="departement">
			<option value="0">Choisissez un département</option>
	<?php 
		foreach ($departements as $departement) {
			echo '<option value="'.$departement['departement_id'].'"'.($infos_groupe['id_departement'] == $departement['departement_id'] ? ' selected=""' : null).'>'.$departement['departement_code'].' - '.$departement['departement_nom'].'</option>';
		}
	?>
		</select><br>

		<label for="image">Photo du groupe</label>
		<input type="file" name="image" accept="image/*"><br>
		
		<label for="description">Description</label>
		<textarea name="description" cols="50" rows="10" id="description"><?php echo $infos_groupe['description']; ?></textarea><br>
		
		<label>Nombre de participants</label> 
		<input type="number" name="min_participants" value="<?php echo $infos_groupe['min_participants']; ?>" step="1" min="0"> à 
		<input type="number" name="max_participants" value="<?php echo $infos_groupe['max_participants']; ?>" step="1" min="0"> (0 pour illimité)<br>
		
		<label for="visibilite">Visibilité</label>
		<select id="visibilite" name="visibilite">
			<option value="public"<?php echo ($infos_groupe['visibilite'] == 'public' ? ' selected=""' : null); ?>>Public</option>
			<option value="prive"<?php echo ($infos_groupe['visibilite'] == 'prive' ? ' selected=""' : null); ?>>Privé</option>
		</select><br>
		
		<label for="recurrence">Récurrence</label>
		<select id="recurrence" name="recurrence">
			<option value="occasionnel"<?php echo ($infos_groupe['recurrence'] == 'occasionnel' ? ' selected=""' : null); ?>>Occasionnel</option>
			<option value="quotidien"<?php echo ($infos_groupe['recurrence'] == 'quotidien' ? ' selected=""' : null); ?>>Quotidien</option>
			<option value="hebdomadaire"<?php echo ($infos_groupe['recurrence'] == 'hebdomadaire' ? ' selected=""' : null); ?>>Hebdomadaire</option>
			<option value="mensuel"<?php echo ($infos_groupe['recurrence'] == 'mensuel' ? ' selected=""' : null); ?>>Mensuel</option>
			<option value="annuel"<?php echo ($infos_groupe['recurrence'] == 'annuel' ? ' selected=""' : null); ?>>Annuel</option>
		</select><br>
		
		<label for="niveau">Niveau sportif</label>
		<select id="niveau" name="niveau">
			<option value="1"<?php echo ($infos_groupe['niveau'] == 1 ? ' selected=""' : null); ?>>Débutant</option>
			<option value="2"<?php echo ($infos_groupe['niveau'] == 2 ? ' selected=""' : null); ?>>Moyen</option>
			<option value="3"<?php echo ($infos_groupe['niveau'] == 3 ? ' selected=""' : null); ?>>Confirmé</option>
		</select><br>
		
		<input type="hidden" name="type" value="modifier">
		<input type="submit" value="Modifier le groupe" class="float-right">
	</form>
</div>