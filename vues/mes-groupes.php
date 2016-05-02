	<div class="profil gauche">
		<div>
			<img src="<?php echo (is_file(DOSSIER_AVATAR . $_SESSION['id'] . '.jpg') ? DOSSIER_AVATAR . $_SESSION['id'] . '.jpg' : 'static/images/profil.jpg'); ?>" class="photo">
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
	</div>
	<div class="clear"></div>