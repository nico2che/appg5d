<div class="ajouter-groupe">
	<h3>Ajouter un sport</h3>
	<form action="" method="post">
		<label for="nom">Nom du groupe : </label> <input type="text" id="nom" name="nom"><br>
		<label for="sport">Sport de ce groupe : </label>
		<select id="sport" name="sport">
			<option>Choisissez un sport</option>
	<?php 
		foreach ($sports as $sport) {
			echo '<option value="'.$sport['id'].'">'.$sport['nom'].'</option>';
		}
	?>
		</select><br>
		<label for="description">Description</label><br>
		<textarea name="description" cols="50" rows="10" id="description"></textarea><br>
		<label for="visibilite">Visibilité : </label>
		<select id="visibilite" name="visibilite">
			<option>Public</option>
			<option>Privé</option>
		</select><br>
		<label for="recurrence">Récurrence : </label>
		<select id="recurrence" name="recurrence">
			<option>Occasionnel</option>
			<option>Quotidien</option>
			<option>Hebdomadaire</option>
			<option>Mensuel</option>
			<option>Annuel</option>
		</select>
	</form>
</div>