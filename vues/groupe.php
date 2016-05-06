<div class="groupe">
	<div class="photo" style="background-image: url('static/user/groupes/tennis_1.png');"></div>
	<div class="details">
		<h2><?php echo $infos_groupe['titre']; ?></h2>
		<p class="specifications">
			<span>Créé par <?php echo $infos_groupe['prenom']; ?></span>
			<span><i class="fa fa-fire"></i> <?php echo $infos_groupe['nom_sport']; ?></span>
			<span><i class="fa fa-calendar"></i> <?php echo $infos_groupe['recurrence']; ?></span>
			<span><i class="fa fa-users"></i> 2 personnes sur <?php echo $infos_groupe['max_participants']; ?></span>
		</p>
		<p class="description"><?php echo nl2br($infos_groupe['description']); ?></p>
		<h3>Dates</h3>
		<p>Cet événement est <?php echo $infos_groupe['recurrence']; ?>.<br>Voici les dates actuellement proposées par le créateur de ce groupe.</p>
	</div>
</div>
