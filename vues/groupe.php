<div class="groupe">
<?php
	if(!connecte()) {
?>
	<div class="message erreur">
		Vous devez être connecté pour voir ce groupe.
	</div>
<?php
	} elseif(empty($infos_groupe)) {
?>
	<div class="message erreur">
		Ce groupe n'existe pas ou plus.
	</div>
<?php
	} else {
?>
	<div class="photo" style="background-image: url('<?php echo (is_file(DOSSIER_GROUPE . $infos_groupe['id'] . '.jpg') ? DOSSIER_GROUPE . $infos_groupe['id'] . '.jpg' : DOSSIER_GROUPE . '0.jpg') ?>');"></div>
	<div class="details">
		<a class="lien-titre" href="?page=groupe&amp;id=<?php echo $id_groupe; ?>"><h2><?php echo $infos_groupe['titre']; ?></h2></a>
		<div class="liste-encadrer">
			<div class="encadrer specifications">
				<span>Créé par <?php echo $membres_groupe['types'][1][0]['prenom']; ?></span>
				<span><i class="fa fa-fire"></i> <?php echo $infos_groupe['nom_sport']; ?></span><br><br>
				<span><i class="fa fa-calendar"></i> <?php echo ucfirst($infos_groupe['recurrence']); ?></span>
				<span><i class="fa fa-users"></i> <?php echo ($infos_groupe['max_participants'] > 0 ? count($membres_groupe['tous']) . ' participants sur ' . $infos_groupe['max_participants'] : count($membres_groupe['tous']) . ' participants'); ?></span>
			</div>
			<p class="encadrer"><?php echo nl2br($infos_groupe['description']); ?></p>
		</div>
		<h3>Dates de rencontre</h3>
		<p>Cet événement est <?php echo $infos_groupe['recurrence']; ?>.<br>Voici la ou les dates actuellement proposées par le créateur de ce groupe.</p>
	<?php
		if(!empty($messages)) {
	?>
		<div class="message <?php echo $messages['type']; ?>">
			<?php echo $messages['message']; ?>
		</div>
	<?php
		}
	?>
		<div class="liste-encadrer">
	<?php
		if(est_auteur_groupe($membres_groupe)) {
	?>
			<div class="encadrer">
				<h4>Ajouter une date</h4>
				<form method="post">
					<u>Date</u> :
					<select name="jour">
						<?php genererSelect(0, 31, date('d')); ?>
					</select>
					<select name="mois">
						<?php
							foreach ($mois as $cle => $nomMois) {
								$numMois = $cle+1;
								echo '<option '.($numMois == date('m') ? 'selected=""' : null).' value="'.$numMois.'">'.$nomMois.'</option>';
							}
						?>
					</select>
					<select name="annee">
						<?php genererSelect(date('Y'), (date('Y') + 4), date('Y'), true); ?>
					</select>
					&nbsp; à &nbsp;
					<select name="heure">
						<?php genererSelect(0, 23, date('H'), true); ?>
					</select>
					h
					<select name="minute">
						<?php genererSelect(0, 59, date('i'), true); ?>
					</select><br><br>
					<u>Lieu</u> :
					<input type="text" name="localisation" id="localisationAutoCompletion" style="width:322px;"> <br><br>
					<u>Durée</u> :
					<select name="duree_heure">
						<?php genererSelect(0, 23, 01, true); ?>
					</select>
					<label>heure(s)</label>
					<select name="duree_minute">
						<?php genererSelect(0, 59, 00, true); ?>
					</select>
					<label>minute(s)</label><br><br>
					<input type="hidden" name="latitude" id="localisation_la">
					<input type="hidden" name="longitude" id="localisation_lo">
					<input type="submit" value="Ajouter">
				</form>
			</div>
	<?php 
		}

		if(!empty($dates_groupe)) {

			foreach ($dates_groupe as $date) {
	?>
			<div class="encadrer dates" style="padding:0;">
				<a href="#" class="participation" data-id="<?php echo $date['infos'][0]; ?>" data-idgroupe="<?php echo $id_groupe; ?>">
					<div class="participer <?php echo (in_array($_SESSION['id'], $date['membres']) ? 'vert' : null); ?>">
						<img src="static/images/ajax-loader-2.gif" style="display:none;" class="loader-participation">
						<i class="fa fa-calendar-<?php echo (in_array($_SESSION['id'], $date['membres']) ? 'check' : 'plus'); ?>-o"></i>
					</div>
				</a>
			<?php
				$dateTime = new DateTimeFrench($date['infos']['date']);
				echo '	<div class="date">
							<span class="jour">'.$dateTime->format('l').'</span><br>
							<span class="numero">'.$dateTime->format('d').'</span><br>
							<span class="mois">'.$dateTime->format('F').'</span>
						</div>';
			?>
				<div class="details-date">
			<?php
				if(est_auteur_groupe($membres_groupe)) {
			?>
					<a href="#" class="supprimer-date" data-id="<?php echo $date['infos'][0]; ?>" data-idgroupe="<?php echo $id_groupe; ?>">
						<i class="fa fa-trash" style="float:right"></i>
					</a>
			<?php
				}
				$heureTime = new DateTimeFrench($date['infos']['duree']);
			?>
					<span class="heure">à <?php echo $dateTime->format('H\hi'); ?>, pendant <?php echo $heureTime->format('G\hi'); ?></span><br>
					<a href="#" class="lieu" data-coordonnees="<?php echo $date['infos']['coordonnees']; ?>">
						<span class="localisation"><?php echo $date['infos']['localisation']; ?></span>
					</a>
				</div>
			</div>
	<?php
			}

		} else {
	?>
		<div class="encadrer">
			Aucune date n'existe encore pour ce groupe.
		</div>
	<?php
		}
	?>
		</div>
	</div>
	<div class="participants">
	<?php
		if(est_auteur_groupe($membres_groupe)) {
	?>
		<div class="align-center" style="margin:30px 0;"><a href="?page=groupe&amp;id=<?php echo $id_groupe; ?>&amp;modifier" class="bouton b-principal">Modifier le groupe</a></div>
		<div class="align-center" style="margin:30px 0;"><a href="?page=groupe&amp;id=<?php echo $id_groupe; ?>&amp;supprimer" class="bouton b-danger">Supprimer le groupe</a></div>
	<?php 
		} elseif(est_membre_groupe($id_groupe, $_SESSION['id'])) {
	?>
		<div class="align-center" style="margin:30px 0;"><a href="?page=groupe&amp;id=<?php echo $id_groupe; ?>&amp;quitter" class="bouton b-danger">Quitter le groupe</a></div>
	<?php 
		} else {
	?>
		<div class="align-center" style="margin:30px 0;"><a href="?page=groupe&amp;id=<?php echo $id_groupe; ?>&amp;rejoindre" class="bouton b-principal">Rejoindre le groupe</a></div>
	<?php 
		}
	?>
		<div class="encadrer">
	<?php echo count($membres_groupe['tous']); ?> membres<br><br>
	<?php 
		foreach ($membres_groupe['tous'] as $membre) {
			echo '<div class="participant" title="'.$membre['prenom'].'" style="background-image:url(\''.(is_file(chemin_avatar($membre['id'])) ? chemin_avatar($membre['id']) : chemin_avatar('0')).'\');"></div>';
		}
	?>
		</div>
	</div>
<?php
	}
?>
</div>
<div class="clear"></div>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="static/js/gmaps.js"></script>
