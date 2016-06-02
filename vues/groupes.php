<?php
	if(connecte()) {
?>
	<a href="?page=groupe&amp;ajouter" class="bouton b-principal float-right">Ajouter un groupe</a>
<?php
	}
?>
	<h1><a href="?page=groupes" class="lien-simple">Groupes</a></h1>
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
				<label for="nbre_min">Limite de participant(s) entre </label> <input min="0" type="number" value="<?php echo (isset($_GET['min']) ? htmlspecialchars($_GET['min']) : 0); ?>" name="min"> 
				<label for="nbre_max"> et </label> <input type="number" min="0" value="<?php echo (isset($_GET['max']) ? htmlspecialchars($_GET['max']) : 0); ?>" name="max" id="nbre_max"> &nbsp;(0 pour illimité) <label for="nbre_actuel">, avec au moins </label> <input type="number" min="0" value="<?php echo (isset($_GET['actuel']) ? htmlspecialchars($_GET['actuel']) : 0); ?>" name="actuel"> participant(s) actuel(s)<br>
				
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
				</select><br>

				<label for="niveau">Niveau sportif</label> &nbsp;
				<select id="niveau" name="niveau">
					<option value="0">-- Sélectionnez un niveau --</option>
					<option value="1"<?php echo (isset($_GET['niveau']) && $_GET['niveau'] == 1 ? ' selected=""' : null); ?>>Tout</option>
					<option value="2"<?php echo (isset($_GET['niveau']) && $_GET['niveau'] == 2 ? ' selected=""' : null); ?>>Débutant</option>
					<option value="3"<?php echo (isset($_GET['niveau']) && $_GET['niveau'] == 3 ? ' selected=""' : null); ?>>Moyen</option>
					<option value="4"<?php echo (isset($_GET['niveau']) && $_GET['niveau'] == 4 ? ' selected=""' : null); ?>>Confirmé</option>
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
	<?php
		if(!empty($groupes)) {

			foreach ($groupes as $groupe) {

				if((!isset($_GET['actuel']) || empty($_GET['actuel'])) || $groupe['nbre'] >= $_GET['actuel']) {
	?>
		<div class="groupe encadrer">
			<a href="?page=groupe&amp;id=<?php echo $groupe['id_groupe']; ?>" title="<?php echo $groupe['titre']; ?>">
				<div class="details">
					<div class="photo" style="background-image: url('<?php echo (is_file(DOSSIER_GROUPE . $groupe['id_groupe'] . '.jpg') ? DOSSIER_GROUPE . $groupe['id_groupe'] . '.jpg' : DOSSIER_GROUPE . '0.jpg') ?>');"></div>
					<h4><?php echo $groupe['titre']; ?></h4>
					<p>
						<i class="fa fa-fire"></i> <?php echo $groupe['nom_sport']; ?><br>
						<i class="fa fa-calendar"></i> <?php echo ucfirst($groupe['recurrence']); ?><br>
						<i class="fa fa-users"></i> <?php echo $groupe['nbre']; ?> participant<?php echo ($groupe['nbre'] > 1 ? 's' : null); ?><?php echo ($groupe['max_participants'] > 0 ? ' sur ' . $groupe['max_participants'] : null);  ?><br>
					</p>
				</div>
			</a>
		</div>
	<?php
				}
			}
	?>
		<div class="clear"></div>
	<?php
			pagination($total_groupes);

		} else {
	?>
		<div class="groupe encadrer align-center" style="width:98%;padding-top:10px;">
			<h4>Aucun résultat</h4>
		</div>
	<?php
		}
	?>
	</div>