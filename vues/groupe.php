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
		<a href="?page=groupe&amp;id=<?php echo $id_groupe; ?>"><h2><?php echo $infos_groupe['titre']; ?></h2></a>
	<?php
		if(isset($membres_groupe[1]) && $membres_groupe[1]['id'] == $_SESSION['id']) {
	?>
		<div class="moderer_groupe">
			Vous êtes le créateur de ce groupe. Vous pouvez le <a href="?page=groupe&amp;id=<?php echo $id_groupe; ?>&amp;modifier">modifier</a> ou le <a href="?page=groupe&amp;id=<?php echo $id_groupe; ?>&amp;supprimer">supprimer</a>.
		</div>
	<?php 
		}
	?>
		<p class="specifications">
			<span>Créé par <?php echo $membres_groupe[1]['prenom']; ?></span>
			<span><i class="fa fa-fire"></i> <?php echo $infos_groupe['nom_sport']; ?></span>
			<span><i class="fa fa-calendar"></i> <?php echo $infos_groupe['recurrence']; ?></span>
			<span><i class="fa fa-users"></i> 2 personnes sur <?php echo $infos_groupe['max_participants']; ?></span>
		</p>
		<p class="description"><?php echo nl2br($infos_groupe['description']); ?></p>
		<h3>Dates</h3>
		<p>Cet événement est <?php echo $infos_groupe['recurrence']; ?>.<br>Voici la ou les dates actuellement proposées par le créateur de ce groupe.</p>
	<?php
		if(isset($membres_groupe[1]) && $membres_groupe[1]['id'] == $_SESSION['id']) {
			
			if(!empty($messages)) {
	?>
		<div class="message <?php echo $messages['type']; ?>">
			<?php echo $messages['message']; ?>
		</div>
	<?php
			}
	?>
		<div class="encadrer">
			<h4>Ajouter une date</h4>
			<form method="post">
				<input type="text" name="date" placeholder="Date (dd/mm/YYYY)"> 
				<input type="text" name="localisation" id="localisationAutoCompletion"> 
				<input type="text" name="duree" placeholder="Durée (hh:mm)" style="width:100px">
				<input type="submit" value="Ajouter">
			</form>
		</div>
	<?php 
		}
	?>
		<div class="dates">
	<?php
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
</div>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
