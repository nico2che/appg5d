	<div id="cover"></div>
	<a href="?page=groupe&amp;ajouter" class="bouton b-principal" style="display: block; width: 10vw; text-align: center; background-color:#D54F58">Ajouter un groupe</a>
	<h2>Groupes</h2>
	<div class="recherche encadrer">
		<h3>Recherche</h3>
		<form class="inputs" onSubmit="return false;">
			<input type="text" name="recherche" placeholder="Nom d'un groupe">
			<select name="sport">
				<option value="">-- Sport --</option>
			<?php
				foreach ($sports as $sport) {
			?>
				<option value="<?php echo $sport['id']; ?>"><?php echo $sport['nom']; ?></option>
			<?php
				}
			?>
			</select>
			<select name="recurrence">
				<option value="">-- Récurrence --</option>
				<option value="occasionnel">Occasionnel</option>
				<option value="quotidien">Quotidien</option>
				<option value="hebdomadaire">Hebdomadaire</option>
				<option value="mensuel">Mensuel</option>
				<option value="annuel">Annuel</option>
			</select>
		</form>
		<div class="clear"></div>
	</div>
	<div class="align-center charge-groupe" style="display:none;"><img src="static/images/ajax-loader-2.gif" alt="Chargement..."></div>
	<div id="liste-groupes">
	<?php foreach ($groupes as $groupe): ?>
		<div class="groupe encadrer">
			<a href="?page=groupe&amp;id=<?php echo $groupe['id']; ?>">
				<div class="details">
					<div class="photo" style="background-image: url('<?php echo (is_file(DOSSIER_GROUPE . $groupe['id'] . '.jpg') ? DOSSIER_GROUPE . $groupe['id'] . '.jpg' : DOSSIER_GROUPE . '0.jpg') ?>');"></div>
					<h4><?php echo $groupe['titre']; ?></h4>
					<p>
						<i class="fa fa-fire"></i> <?php echo $groupe['nom_sport']; ?><br>
						<i class="fa fa-calendar"></i> <?php echo ucfirst($groupe['recurrence']); ?><br>
						<i class="fa fa-users"></i> 2 personnes sur <?php echo $groupe['max_participants']; ?><br>
					</p>
				</div>
			</a>
		</div>
	<?php endforeach; ?>
	</div>