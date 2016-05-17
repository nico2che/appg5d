<div class="form-groupe">
	<h3>Modifier un sport</h3>
	<form action="" method="post">
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
		<label for="description">Description</label>
		<textarea name="description" cols="50" rows="10" id="description"><?php echo $infos_groupe['description']; ?></textarea><br>
		<label for="visibilite">Visibilité</label>
		<select id="visibilite" name="visibilite">
			<option value="public"<?php echo ($infos_groupe['visibilite'] == 'public' ? ' selected=""' : null); ?>>Public</option>
			<option value="prive"<?php echo ($infos_groupe['visibilite'] == 'public' ? ' selected=""' : null); ?>>Privé</option>
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
		<input type="submit" value="Modifier le sport" class="float-right">
	</form>
</div>