	<div class="profil gauche">
		<div>
			<img src="static/images/profil.jpg" class="photo">
			<a href="#" class="modifier-photo"><i class="fa fa-camera"></i> &nbsp; Modifier la photo</a>
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
		<form action="" method="post" id="informations-profil">
			<h2>Mon Profil</h2>
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
			<hr>
			<div style="margin-top:35px;">
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