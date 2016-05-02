	<div class="profil gauche">
		<div>
			<img src="<?php echo (is_file(DOSSIER_AVATAR . $_SESSION['id'] . '.jpg') ? DOSSIER_AVATAR . $_SESSION['id'] . '.jpg' : 'static/images/profil.jpg'); ?>" class="photo">
			<a href="#" class="modifier-photo"><i class="fa fa-camera"></i> &nbsp; Modifier la photo</a>
			<form id="form_avatar" style="display: none;" enctype="multipart/form-data">
				<input type="file" name="photo" style="display: none;" id="avatar_fichier">
			</form>
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
		<form action="" method="post" class="formulaire-profil">
			<h2>Mon Profil</h2>
		<?php if(!empty($messages['information'])): ?>
			<div class="message <?php echo $messages['information']['type']; ?>">
				<?php echo $messages['information']['message']; ?>
			</div>
		<?php endif; ?>
			<div>
				<label for="prenom">Prénom</label>
				<input type="text" name="prenom" id="prenom" value="<?php echo $informations['prenom']; ?>">
			</div>
			<div>
				<label for="nom">Nom</label>
				<input type="text" name="nom" id="nom" value="<?php echo $informations['nom']; ?>">
			</div>
			<div>
				<label for="email">Email</label>
				<input type="text" name="email" id="email" value="<?php echo $informations['email']; ?>">
			</div>
			<div class="align-right">
				<input type="submit">
			</div>
		</form>
		<form action="" method="post" class="formulaire-profil">
			<hr style="margin-bottom:35px;">
		<?php if(!empty($messages['mot_de_passe'])): ?>
			<div class="message <?php echo $messages['mot_de_passe']['type']; ?>">
				<?php echo $messages['mot_de_passe']['message']; ?>
			</div>
		<?php endif; ?>
			<div>
				<label>Mot de passe</label>
				<input type="password" name="mot_de_passe" autocomplete="off">
			</div>
			<div>
				<label>Confirmation du mot de passe</label>
				<input type="password" name="confirmation_mot_de_passe">
			</div>
			<div class="align-right">
				<input type="submit">
			</div>
		</form>
	</div>
	<div class="clear"></div>