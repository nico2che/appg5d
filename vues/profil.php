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
				<li><a href="?page=profil">Résumé</a></li>
				<li><a href="?page=mon-profil">Mon Profil</a></li>
				<li><a href="?page=mon-planning">Mon Planning</a></li>
			</ul>
		</div>
	<?php } ?>
	</div>
	<div class="profil droite resume">

		<h2 style="display:inline-block"><?php echo htmlspecialchars($informations['pseudo']); ?></h2>

	<?php
		if($moi) {
	?>
		 &nbsp; (<a href="?page=mon-profil" class="lien-simple">Modifier</a>)
	<?php 
		} else {
	?>
		<div class="encadrer padde">
			<p><?php echo (empty($informations['description']) ? '<i>Aucune description</i>' : htmlspecialchars($informations['description'])); ?></p>
		</div><br>
	<?php 
		}
		if($moi) {
	?>
		<h3>Invitations</h3>
		<p>
			Vous avez <b><?php echo count($invitations); ?></b> invitation<?php echo (count($invitations) > 1 ? 's' : null); ?> en attente
		</p>
	<?php
			if(!empty($invitations)) {
	?>
		<div class="liste-encadrer liste-profil">
	<?php
				foreach ($invitations as $invitation) {

					$date = new DateTimeFrench($invitation['date']);
	?>
			<div class="encadrer">
				<a href="?page=groupe&amp;id=<?php echo $invitation['id_groupe']; ?>">
					<div class="photo" style="background-image: url('<?php echo (is_file(DOSSIER_GROUPE . $invitation['id_groupe'] . '.jpg') ? DOSSIER_GROUPE . $invitation['id'] . '.jpg' : DOSSIER_GROUPE . '0.jpg') ?>');"></div>
					<div class="details">
						<span class="point"><i class="fa fa-fire"></i> <?php echo $invitation['nom_sport']; ?></span><span class="point"><i class="fa fa-calendar"></i> <?php echo ucfirst($invitation['recurrence']); ?></span><span class="point"><i class="fa fa-bar-chart"></i> <?php echo $niveaux[$invitation['niveau']]; ?></span><br>
						<b><?php echo htmlspecialchars($invitation['titre']); ?></b><br>
						<?php echo $date->format('l j F à H\hi'); ?>
					</div>
				</a>
				<div class="reponse accepter"><a href="#"><i class="fa fa-thumbs-up"></i></a></div>
				<div class="reponse refuser"><a href="#"><i class="fa fa-thumbs-down"></i></a></div>
			</div>
	<?php
				}
	?>
		</div><br>
	<?php
			}
		}
	?>
		<h3><?php if($moi) { ?>Mes <?php } ?>Groupes</h3>
		<p>
			<?php if($moi) { ?>Vous êtes dans<?php } else { echo htmlspecialchars($informations['pseudo']); ?> est dans<?php } ?> <b><?php echo (isset($groupes['tous']) ? count($groupes['tous']) : 0); ?></b> groupe<?php echo (isset($groupes['tous']) && count($groupes['tous']) > 1 ? 's' : null); ?> au total
		</p>
		<h4> - <?php echo (isset($groupes['types'][1]) ? count($groupes['types'][1]) : 0); ?> en tant que responsable</h4>
		<div class="liste-encadrer liste-profil groupes">
			<?php 
				if(!empty($groupes['types'][1])) {
					foreach ($groupes['types'][1] as $infos) {
			?>

			<div class="encadrer">
				<a href="?page=groupe&amp;id=<?php echo $infos['id_groupe']; ?>">
					<div class="photo" style="background-image: url('<?php echo (is_file(DOSSIER_GROUPE . $infos['id_groupe'] . '.jpg') ? DOSSIER_GROUPE . $infos['id_groupe'] . '.jpg' : DOSSIER_GROUPE . '0.jpg') ?>');"></div>
					<div class="details">
						<span class="point"><i class="fa fa-fire"></i> <?php echo $infos['nom_sport']; ?></span><span class="point"><i class="fa fa-calendar"></i> <?php echo ucfirst($infos['recurrence']); ?></span><span class="point"><i class="fa fa-bar-chart"></i> <?php echo $niveaux[$infos['niveau']]; ?></span><br>
						<b><?php echo htmlspecialchars($infos['titre']); ?></b>
					</div>
				</a>
			</div>
			<?php
					}
				} else {
					echo '<div class="encadrer aucun">Aucun groupe</div>';
				}
			?>
		</div>
		<h4> - <?php echo (isset($groupes['types'][0]) ? count($groupes['types'][0]) : 0); ?> en tant qu'inscrit</h4>
		<div class="liste-encadrer liste-profil groupes">
			<?php 
				if(!empty($groupes['types'][0])) {
					foreach ($groupes['types'][0] as $infos) {
			?>
			<div class="encadrer">
				<a href="?page=groupe&amp;id=<?php echo $infos['id_groupe']; ?>">
					<div class="photo" style="background-image: url('<?php echo (is_file(DOSSIER_GROUPE . $infos['id_groupe'] . '.jpg') ? DOSSIER_GROUPE . $infos['id_groupe'] . '.jpg' : DOSSIER_GROUPE . '0.jpg') ?>');"></div>
					<div class="details">
						<span class="point"><i class="fa fa-fire"></i> <?php echo $infos['nom_sport']; ?></span><span class="point"><i class="fa fa-calendar"></i> <?php echo ucfirst($infos['recurrence']); ?></span><span class="point"><i class="fa fa-bar-chart"></i> <?php echo $niveaux[$infos['niveau']]; ?></span><br>
						<b><?php echo htmlspecialchars($infos['titre']); ?></b>
					</div>
				</a>
			</div>
			<?php
					}
				} else {
					echo '<div class="encadrer aucun">Aucun groupe</div>';
				}
			?>
		</div>
	</div>
	<div class="clear"></div>
<?php
	}
?>