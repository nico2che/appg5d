	<div class="profil gauche">
		<div class="photo" style="background-image:url('<?php echo (is_file(DOSSIER_AVATAR . $_SESSION['id'] . '.jpg') ? DOSSIER_AVATAR . $_SESSION['id'] . '.jpg' : 'static/images/profil.jpg'); ?>')">
		</div>
		<div class="navigation">
			<ul>
				<li><a href="?page=mon-profil">Mon Profil</a></li>
				<li><a href="?page=mon-planning">Mon Planning</a></li>
				<li><a href="?page=mes-groupes">Mes Groupes</a></li>
			</ul>
		</div>
	</div>
	<div class="profil droite">
		<h2>Mes Groupes</h2>
		<h3>Ce mois-ci</h3>
		<ul>
			<?php 
				if(!empty($groupes_ce_mois)) {
					foreach ($groupes_ce_mois as $date => $groupe) {
						$dateFormat = new DateTimeFrench($date);
						foreach ($groupe as $infos) {
							echo '<li>'.$dateFormat->format('d F') . " - " . $infos['titre'].'</li>';
						}
					}
				} else {
					echo 'Vous n\'êtes inscrit dans aucun groupe pour ce mois-ci';
				}
			?>
		</ul>
		<h3>Le mois prochain</h3>
		<ul>
			<?php
				if(!empty($groupes_mois_prochain)) {
					foreach ($groupes_mois_prochain as $date => $groupe) {
						$dateFormat = new DateTimeFrench($date);
						foreach ($groupe as $infos) {
							echo '<li>'.$dateFormat->format('d F') . " - " . $infos['titre'].'</li>';
						}
					}
				} else {
					echo 'Vous n\'êtes inscrit dans aucun groupe pour le mois prochain';
				}
			?>
		</ul>
	</div>
	<div class="clear"></div>