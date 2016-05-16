<div id="cover"></div>
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
	<div class="photo" style="background-image: url('static/user/groupes/tennis_1.png');"></div>
	<div class="details">
		<a class="lien-titre" href="?page=groupe&amp;id=<?php echo $id_groupe; ?>"><h2><?php echo $infos_groupe['titre']; ?></h2></a>
		<div class="liste-encadrer">
			<div class="encadrer">
				<p class="specifications">
					<span>Créé par <?php echo $membres_groupe['types'][1][0]['prenom']; ?></span>
					<span><i class="fa fa-fire"></i> <?php echo $infos_groupe['nom_sport']; ?></span>
					<span><i class="fa fa-calendar"></i> <?php echo $infos_groupe['recurrence']; ?></span>
					<span><i class="fa fa-users"></i> <?php echo count($membres_groupe['tous']); ?> personnes sur <?php echo $infos_groupe['max_participants']; ?></span>
				</p>
			</div>
			<p class="encadrer"><?php echo nl2br($infos_groupe['description']); ?></p>
		</div>
		<h3>Dates</h3>
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
					<input type="text" name="localisation" id="localisationAutoCompletion"> <br><br>
					<u>Durée</u> :
					<select name="duree_heure">
						<?php genererSelect(0, 23, 01, true); ?>
					</select>
					<label>heure(s)</label>
					<select name="duree_minute">
						<?php genererSelect(0, 59, 00, true); ?>
					</select>
					<label>minute(s)</label><br><br>
					<input type="submit" value="Ajouter">
				</form>
			</div>
	<?php 
		}

		if(!empty($dates_groupe)) {

			foreach ($dates_groupe as $date) {
	?>
			<div class="encadrer">
				<span style="float:right"><?php echo $date['localisation']; ?></span>
				Le <?php
					$dateTime = new DateTimeFrench($date['date']);
					echo $dateTime->format('l d F');
				?>, pendant 
				<?php 
					$heureTime = new DateTimeFrench($date['duree']);
					echo $heureTime->format('G\hi');
				?>
			</div>
	<?php
			}

		} else {
	?>
		Aucune date n'existe encore pour ce groupe.
	<?php
		}
	?>
		</div>
	</div>
<?php
	}
?>
	<div class="participants">
	<?php
		if(est_auteur_groupe($membres_groupe)) {
	?>
		<div class="align-center" style="margin:30px 0;"><a href="?page=groupe&amp;id=<?php echo $id_groupe; ?>&amp;modifier" class="bouton b-principal">Modifier le groupe</a></div>
		<div class="align-center" style="margin:30px 0;"><a href="?page=groupe&amp;id=<?php echo $id_groupe; ?>&amp;supprimer" class="bouton b-danger">Supprimer le groupe</a></div>
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
</div>
<div class="clear"></div>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
