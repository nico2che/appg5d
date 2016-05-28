	<div id="cover"></div>
	<h1><a href="?page=forum">Forum</a></h1>
	<?php
		if(isset($message))
			echo '<p>'.$message.'</p>';

		$date_sujet = new DateTimeFrench($sujet['date']);
	?>
	<h3><?php echo $sujet['titre']; ?></h3>
	<?php
		if($sujet['id_membre'] == $_SESSION['id']) {
	?>
		<p><a href="?page=modifier-sujet&amp;sujet=<?php echo $sujet['id_sujet']; ?>">Modifier le sujet</a></p>
	<?php
		}
	?>
	<div class="liste-encadrer">
		<div class="encadrer">
			<span class="message-infos">Rédigé par <?php echo $sujet['prenom'] . ' '. $sujet['nom']; ?><span class="float-right">le <?php echo $date_sujet->format('d F Y'); ?> à <?php echo $date_sujet->format('H:i'); ?></span></span>
			<hr>
			<?php echo nl2br(htmlspecialchars($sujet['message'])); ?>
		</div>
	<?php
		foreach($messages as $message) {
			
			$date_reponse = new DateTimeFrench($message['date']);
	?>
		<div class="encadrer">
			<span class="message-infos">Réponse de <?php echo $message['prenom'] . ' '. $message['nom']; ?> <span class="float-right">le <?php echo $date_reponse->format('d F Y'); ?> à <?php echo $date_reponse->format('H:i'); ?></span></span>
			<hr>
			<?php echo nl2br(htmlspecialchars($sujet['message'])); ?>
		</div>
	<?php
		}
	?>
		<div class="encadrer">
			<form method="post" action="">
				<label for="message">Répondre : </label><br>
				<textarea name="message" id="message" rows="10" cols="70"></textarea><br>
				<input type="submit" value="Envoyer">
			</form>
		</div>
	</div>