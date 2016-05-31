	<a href="?page=groupe&amp;ajouter" class="bouton b-principal float-right">Ajouter un groupe</a>
	<h2>Groupes</h2>
	<div class="recherche encadrer">
		<form class="inputs<?php echo (!isset($_GET['recherche']) ? ' recherche-simple' : null); ?>"<?php echo (!isset($_GET['recherche']) ? ' onSubmit="return false;"' : null); ?>>
			<h3>Recherche</h3>
			<input type="text" name="recherche" placeholder="Nom d'un groupe" class="decale-droite" value="<?php echo (isset($_GET['recherche']) ? htmlspecialchars($_GET['recherche']) : null); ?>">
			<select name="sport">
				<option value="">-- Sport --</option>
			<?php
				foreach ($sports as $sport) {
			?>
				<option value="<?php echo $sport['id']; ?>"<?php echo ((isset($_GET['sport']) && $_GET['sport'] == $sport['id']) ? ' selected=""' : null); ?>><?php echo $sport['nom']; ?></option>
			<?php
				}
			?>
			</select>
			<select name="recurrence" class="decale-droite">
				<option value="">-- Récurrence --</option>
			<?php
				foreach ($recurrences as $value => $reccurrence) {
			?>
				<option value="<?php echo $value; ?>"<?php echo ((isset($_GET['recurrence']) && $_GET['recurrence'] == $value) ? ' selected=""' : null); ?>><?php echo $reccurrence; ?></option>
			<?php
				}
			?>
			</select>
		<?php
			if(isset($_GET['recherche'])) {
		?>
			<a href="?page=groupes" class="lien-simple">Recherche simple</a>
			<div class="recherche-avancee">
				<label for="nbre_min">Nombre minimum de participants</label> <input type="number" value="<?php echo (isset($_GET['min']) ? htmlspecialchars($_GET['min']) : 0); ?>" name="min" class="decale-droite"> 
				<label for="nbre_max">Nombre maximum de participants</label> <input type="number" value="<?php echo (isset($_GET['max']) ? htmlspecialchars($_GET['max']) : 0); ?>" name="max"> &nbsp;(0 pour illimité)<br>
				<label>Département</label> &nbsp;
				<select name="departement">
					<option value="0">-- Sélectionnez un département --</option>
		<?php
			foreach ($departements as $departement) {
		?>
					<option value="<?php echo $departement['departement_id']; ?>"<?php echo ((isset($_GET['departement']) && $_GET['departement'] == $departement['departement_id']) ? ' selected=""' : null); ?>><?php echo $departement['departement_code']; ?> - <?php echo $departement['departement_nom']; ?></option>
		<?php
			}
		?>
				</select><br>
				<input type="hidden" value="groupes" name="page">
				<input type="submit" value="Rechercher" class="rechercher-bouton">
				<div class="clear"></div>
			</div>
		<?php
			} else {
		?>
			<a href="?page=groupes&amp;recherche" class="lien-simple">Recherche avancée</a>
		<?php
			}
		?>
		</form>
		<div class="clear"></div>
	</div>
	<div class="align-center charge-groupe" style="display:none;"><img src="static/images/ajax-loader-2.gif" alt="Chargement..."></div>
	<div id="liste-groupes">
	<?php foreach ($groupes as $groupe): ?>
		<div class="groupe encadrer">
			<a href="?page=groupe&amp;id=<?php echo $groupe['id']; ?>" title="<?php echo $groupe['titre']; ?>">
				<div class="details">
					<div class="photo" style="background-image: url('<?php echo (is_file(DOSSIER_GROUPE . $groupe['id'] . '.jpg') ? DOSSIER_GROUPE . $groupe['id'] . '.jpg' : DOSSIER_GROUPE . '0.jpg') ?>');"></div>
					<h4><?php echo $groupe['titre']; ?></h4>
					<p>
						<i class="fa fa-fire"></i> <?php echo $groupe['nom_sport']; ?><br>
						<i class="fa fa-calendar"></i> <?php echo ucfirst($groupe['recurrence']); ?><br>
						<i class="fa fa-users"></i> 2 participants<?php echo ($groupe['max_participants'] > 0 ? ' sur ' . $groupe['max_participants'] : null);  ?><br>
					</p>
				</div>
			</a>
		</div>
	<?php endforeach; ?>
	</div>