<?php
	if(empty($informations)) {
?>
	<div class="message erreur">
		Ce club n'existe pas ou plus.
	</div>
<?php
	} else {
?>
	<h1><a href="?page=clubs" class="lien-simple"><?php echo $club['nom'] ?></a></h1>
	<div class="encadrer details ">
		<span class="label">Adresse :</span> <?php echo $club['localisation'].", ".$club['code_postale']; ?>
		<?php
			$chaine_sport = '';
			foreach ($sports as $sport) {
				$chaine_sport .= trim($sport['nom_sport']).', ';
			}

			if(!empty($chaine_sport) && $chaine_sport != ', ')
				echo '<br><span class="label">Sport(s) :</span> '.rtrim($chaine_sport, ', ');
			else
				echo '<br><span class="label">Sport(s) :</span> Aucun';

			if ($club['site']!=null)
				echo '<br><span class="label">Site :</span> <a target="_blank" href="'.$club['site'].'" class="lien-simple">'.$club['site'].'</a>';

			if ($club['telephone']!=null)
				echo '<br><span class="label">Telephone :</span> '.$club['telephone'];

			if ($club['email']!=null)
				echo '<br><span class="label">Email :</span> <a href="mailto:'.$club['email'].'" class="lien-simple">'.$club['email'].'</a>';

			if(moyenne($commentaires) != 0)
				echo '<br><span class="label">Note moyenne :</span> '.moyenne($commentaires) . '/5';
		?>
		<br><span class="label">Description :</span> 
		<div class="description"><?php echo nl2br(htmlspecialchars($club['description'])); ?></div>
	</div>
	<div class="image encadrer" style="background-image:url('<?php echo (is_file(DOSSIER_CLUBS . $id_club . '.jpg') ? DOSSIER_CLUBS . $id_club . '.jpg' : 'http://ccfd56.fr/wordpress/wp-content/themes/openmind/img/no_image.png') ?>');"></div>
	<div class="clear"></div>
	<h3>Commentaires</h3>
	<div class="liste-encadrer ">
	<?php
		if(!empty($commentaires) && current($commentaires)['id_commentaire']) {
			foreach($commentaires as $commentaire) {
	?>
		<div class="encadrer">
			<span class="message-infos">Commentaire de <?php echo $commentaire['prenom_membre'] . ' '. $commentaire['nom_membre'] . (connecte() && $commentaire['id_membre'] == $_SESSION['id'] ? ' (<a href="?page=club&id='.$id_club.'&supprimer-message='.$commentaire['id_commentaire'].'&_c='._csrf(false).'" onClick="return confirm(\'Voulez-vous vraiment supprimer votre commentaire ?\');">supprimer</a>)' : null); ?></span>
			<span class="float-right">Note : <?php echo $commentaire['note']; ?>/5</span>
			<hr>
			<?php echo nl2br(htmlspecialchars($commentaire['commentaire'])); ?>
		</div>
	<?php
			}
		} else {
	?>
		<div class="encadrer">
			<p>
				Aucun commentaire pour le moment
			</p>
		</div>
	<?php
		}
	?>
		<div class="encadrer">
			<h4>Ajouter un commentaire</h4>
			<form method="post" action="">
				<label for="note">Attribuer une note à ce club : </label> &nbsp;
	        	<select name="note" id="note">
	        		<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select><br>
				<label for="commentaire">Commentaire : </label><br>
				<textarea name="commentaire" id="commentaire" required="" placeholder="Commentaire obligatoire" rows="7" cols="70"></textarea><br>
				<input type="submit" value="Envoyer">
			</form>
		</div>
	</div>
<?php
	}
?>