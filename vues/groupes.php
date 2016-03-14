	<h2>Groupes</h2>
	<form action="" method="get" class="recherche-groupe">
		<h3>Recherche</h3>
		<div>
			<label>Nom d'un groupe : </label>
			<input type="text" name="mot">
		</div>
		<div>
			<label>Sport : </label>
			<select>
				<option value="1">Tennis</option>
				<option value="2">Golf</option>
				<option value="3">Natation</option>
			</select>
		</div>
		<div>
			<input type="submit" value="Rechercher">
		</div>
	</form>
	<div id="liste-groupes">
	<?php foreach ($groupes as $groupe): ?>
		<div class="groupe">
			<a href="?page=groupe&amp;id=<?php echo $groupe['id']; ?>">
				<div class="details">
					<div class="photo" style="background-image: url('static/user/groupes/tennis_1.png');"></div>
					<h4><?php echo $groupe['titre']; ?></h4>
					<?php echo $groupe['nom_sport']; ?><br>
					<?php echo $groupe['min_participants']; ?> - <?php echo $groupe['max_participants']; ?> personnes<br>
				</div>
			</a>
		</div>
	<?php endforeach; ?>
	</div>