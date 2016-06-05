	<div class="profil gauche">
		<div class="photo" style="background-image:url('<?php echo (is_file(DOSSIER_AVATAR . $_SESSION['id'] . '.jpg') ? DOSSIER_AVATAR . $_SESSION['id'] . '.jpg' : 'static/images/profil.jpg'); ?>')">
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
		<?php if(!empty($messages['informations'])): ?>
			<div class="message <?php echo $messages['informations']['type']; ?>">
				<?php echo $messages['informations']['message']; ?>
			</div>
		<?php endif; ?>
			<div>
				<label for="pseudo">Pseudo *</label>
				<input type="text" name="pseudo" required="" placeholder="Champs obligatoire" id="pseudo" value="<?php echo htmlspecialchars($informations['pseudo']); ?>">
			</div>
			<div>
				<label for="prenom">Prénom *</label>
				<input type="text" name="prenom" required="" placeholder="Champs obligatoire" id="prenom" value="<?php echo htmlspecialchars($informations['prenom']); ?>">
			</div>
			<div>
				<label for="nom">Nom *</label>
				<input type="text" name="nom" required="" placeholder="Champs obligatoire" id="nom" value="<?php echo htmlspecialchars($informations['nom']); ?>">
			</div>
			<div>
				<label for="email">Email *</label>
				<input type="email" required="" placeholder="Champs obligatoire" name="email" id="email" value="<?php echo htmlspecialchars($informations['email']); ?>">
			</div>
			<div>
				<label for="description">Description</label>
				<textarea row="10" cols="50" name="description" id="description" placeholder="Cette description sera publique si vous la renseignez."><?php echo htmlspecialchars($informations['description']); ?></textarea>
			</div>
			<div>
				<label class="label" for="departement">Département</label>
				<select name="departement" id="departement">
					<option value="0">-- Choix du département --</option>
		<?php
			foreach ($departements as $departement) {
		?>
					<option value="<?php echo $departement['departement_id']; ?>"<?php echo ($informations['id_departement'] == $departement['departement_id'] ? ' selected=""' : null); ?>><?php echo $departement['departement_code']; ?> - <?php echo $departement['departement_nom']; ?></option>
		<?php
			}
		?>
				</select>
			</div>
			<div>
				<label class="label">Sexe</label>
				<input type="radio" name="sexe" value="homme" id="homme"<?php echo ($informations['sexe'] == 'homme' ? ' checked=""' : null); ?>> 
				<label for="homme" class="label-radio">Homme</label> &nbsp; 
				<input type="radio" name="sexe" value="femme" id="femme"<?php echo ($informations['sexe'] == 'femme' ? ' checked=""' : null); ?>> 
				<label for="femme" class="label-radio">Femme</label> <br>
			</div>
			<div class="align-right">
				<input type="submit">
			</div>
		</form>
		<form action="" method="post" class="formulaire-profil">
			<hr style="margin-bottom:35px;">
			<h3>Changer de mot de passe</h3>
		<?php if(!empty($messages['mot_de_passe'])): ?>
			<div class="message <?php echo $messages['mot_de_passe']['type']; ?>">
				<?php echo $messages['mot_de_passe']['message']; ?>
			</div>
		<?php endif; ?>
			<div>
				<label for="mot_de_passe_actuel">Mot de passe actuel</label>
				<input type="password" name="mot_de_passe_actuel" autocomplete="off" name="mot_de_passe_actuel">
			</div>
			<div>
				<label for="mot_de_passe">Nouveau mot de passe</label>
				<input type="password" name="mot_de_passe" autocomplete="off" name="mot_de_passe">
			</div>
			<div>
				<label for="confirmation_mot_de_passe">Confirmation du mot de passe</label>
				<input type="password" name="confirmation_mot_de_passe" name="confirmation_mot_de_passe">
			</div>
			<div class="align-right">
				<input type="submit">
			</div>
		</form>
	</div>
	<div class="clear"></div>