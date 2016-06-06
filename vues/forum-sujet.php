	<h1><a href="?page=forum">Forum</a></h1>
	<h3><?php echo $sujet['titre']; ?></h3>
	<?php
		$date_sujet = new DateTimeFrench($sujet['date']);
		if(connecte() && $sujet['id_membre'] == $_SESSION['id']) {
	?>
		<p class="ecarts-y">Vous êtes le créateur de ce sujet. Vous pouvez le <a href="?page=forum&amp;modifier&amp;sujet=<?php echo $sujet['id_sujet']; ?>" class="lien-simple">modifier</a> ou le <a href="?page=forum&amp;supprimer&amp;sujet=<?php echo $sujet['id_sujet']; ?>&amp;_c=<?php echo _csrf(false); ?>" class="lien-simple" onClick="return confirm('Voulez-vous vraiment supprimer ce sujet ?');">supprimer</a>.</p>
	<?php
		}
	?>
	<div class="liste-encadrer ">
		<div class="encadrer">
			<span class="message-infos">Rédigé par <?php echo $sujet['prenom'] . ' '. $sujet['nom']; ?><span class="float-right">le <?php echo $date_sujet->format('d F Y'); ?> à <?php echo $date_sujet->format('H:i'); ?></span></span>
			<hr>
			<?php echo nl2br(htmlspecialchars($sujet['message'])); ?>
		</div>
	<?php

		foreach($messages_sujet as $message) {
			
			$date_reponse = new DateTimeFrench($message['date']);
	?>
		<div class="encadrer">
			<span class="message-infos">Réponse de <?php echo $message['prenom'] . ' '. $message['nom'] . (connecte() && $message['id_membre'] == $_SESSION['id'] ? ' (<a href="?page=forum&sujet='.$id_sujet.'&supprimer-message='.$message['id_message'].'&_c='._csrf(false).'" onClick="return confirm(\'Voulez-vous vraiment supprimer votre message ?\');">supprimer</a>)' : null); ?> <span class="float-right">le <?php echo $date_reponse->format('d F Y'); ?> à <?php echo $date_reponse->format('H:i'); ?></span></span>
			<hr>
			<?php echo nl2br(htmlspecialchars($message['message'])); ?>
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