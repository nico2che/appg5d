	<h1><a href="?page=clubs" class="lien-simple">Clubs</a></h1>
	<div class="recherche encadrer">
		<form class="inputs">
			<h3 class="decale-droite">Recherche</h3>
			<label for="sport">Sport : </label> &nbsp;
			<select name="sport" class="decale-droite" id="sport">
				<option value="">-- Sport --</option>
	<?php
		foreach ($sports as $sport) {
	?>
				<option value="<?php echo $sport['id']; ?>"<?php echo ((isset($_GET['sport']) && $_GET['sport'] == $sport['id']) ? ' selected=""' : null); ?>><?php echo $sport['nom']; ?></option>
	<?php
		}
	?>
			</select>
			<label for="departement">Département : </label> &nbsp;
			<select name="departement" id="departement">
				<option value="0">-- Sélectionnez un département --</option>
	<?php
		foreach ($departements as $departement) {
	?>
				<option value="<?php echo $departement['departement_id']; ?>"<?php echo ((isset($_GET['departement']) && $_GET['departement'] == $departement['departement_id']) ? ' selected=""' : null); ?>><?php echo $departement['departement_code']; ?> - <?php echo $departement['departement_nom']; ?></option>
	<?php
		}
	?>
			</select>
			<input type="hidden" value="clubs" name="page">
			<input type="submit" value="Rechercher" class="rechercher-bouton">
			<div class="clear"></div>
		</form>
		<div class="clear"></div>
	</div>
	<div id="liste-clubs">
	<?php
		if(!empty($clubs)) {

			foreach ($clubs as $club) {

				$nombre_sports = count($club);
	?>
		<div class="club encadrer">
			<a href="?page=club&amp;id=<?php echo $club[0]['id_club']; ?>" title="<?php echo $club[0]['nom_club']; ?>">
				<div class="details">
					<div class="photo" style="background-image: url('<?php echo (is_file(DOSSIER_CLUBS . $club[0]['id_club'] . '.jpg') ? DOSSIER_CLUBS . $club[0]['id_club'] . '.jpg' : 'http://ccfd56.fr/wordpress/wp-content/themes/openmind/img/no_image.png') ?>');"></div>
					<h4><?php echo $club[0]['nom_club']; ?></h4>
					<p>
				<?php
					if(isset($club[0]['nom']) && !empty($club[0]['nom'])) {
				?>
						<i class="fa fa-fire"></i> <?php echo $club[0]['nom'] . ($nombre_sports > 1 ? ' +' . ($nombre_sports - 1) . ' sport' . ($nombre_sports > 2 ? 's' : null) : null); ?><br>
				<?php
					}
				?>
						<i class="fa fa-map-marker"></i> <?php echo $club[0]['localisation']; ?><br>
					</p>
				</div>
			</a>
		</div>
	<?php
			}
	?>
		<div class="clear"></div>
	<?php
			//pagination($total_groupes);

		} else {
	?>
		<div class="encadrer align-center" style="width:98%;padding-top:10px;">
			<h4>Aucun résultat</h4>
		</div>
	<?php
		}
	?>
	</div>
