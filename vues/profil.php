<?php
	if(!isset($informations) || empty($informations)) {
?>
	<div class="message erreur">
		Cet utilisateur n'existe pas ou plus.
	</div>
<?php
	} else {
?>
<div class="profil gauche">
		<div class="photo" style="background-image:url('<?php echo (is_file(DOSSIER_AVATAR . $id_membre . '.jpg') ? DOSSIER_AVATAR . $id_membre . '.jpg' : 'static/images/profil.jpg'); ?>')"></div>
	<?php if(connecte() && $_SESSION['id'] == $id_membre) { ?>
		<div class="navigation">
			<ul>
				<li><a href="?page=profil&amp;id=<?php echo $_SESSION['id']; ?>">Résumé</a></li>
				<li><a href="?page=mon-profil">Mon Profil</a></li>
				<li><a href="?page=mon-planning">Mon Planning</a></li>
			</ul>
		</div>
	<?php } ?>
	</div>
	<div class="profil droite">

		<h2 style="display:inline-block"><?php echo htmlspecialchars($informations['pseudo']); ?></h2>

	<?php if($moi) { ?>

		 &nbsp; (<a href="?page=mon-profil" class="lien-simple">Modifier</a>)

	<?php } else { ?>

		<div class="encadrer padde">
			<p><?php echo (empty($informations['description']) ? '<i>Aucune description</i>' : htmlspecialchars($informations['description'])); ?></p>
		</div><br>

	<?php }
		if($moi) { ?>
		<h3>Invitations</h3>
		<p>
			Vous avez <?php echo count($invitations); ?> invitation en attente
		</p>
	<?php
		}
		if(!empty($invitations)) {
	?>
		<div class="liste-encadrer invitations">
	<?php
			foreach ($invitations as $invitation) {

				$date = new DateTimeFrench($invitation['date']);
	?>
			<div class="encadrer">
				<a href="?page=groupe&amp;id=<?php echo $invitation['id_groupe']; ?>">
					<div class="photo" style="background-image: url('<?php echo (is_file(DOSSIER_GROUPE . $invitation['id'] . '.jpg') ? DOSSIER_GROUPE . $invitation['id'] . '.jpg' : DOSSIER_GROUPE . '0.jpg') ?>');"></div>
					<div class="details"><?php echo $invitation['titre']; ?><br><?php echo $date->format('l j F à H\hi'); ?></div>
				</a>
				<div class="reponse accepter"><a href="#"><i class="fa fa-thumbs-up"></i></a></div>
				<div class="reponse refuser"><a href="#"><i class="fa fa-thumbs-down"></i></a></div>
			</div>
	<?php
			}
	?>
		</div><br>
		<h3>Groupes</h3>
	<?php
		}
	?>
	</div>
	<div class="clear"></div>
<?php
	}
?>