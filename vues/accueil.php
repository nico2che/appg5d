	<div id="cover">
	<!--<img src="static/images/image_accueil.jpg" alt="image test" class="image" >-->
	</div>
	<div class="slogan">La Passion se partage</div>
	
	<h2 class="titreImage texteBase">Nos sports</h2>
	<div class="petitTitre texteBase">Découvrez un grand choix de sport à pratiquer entre amis</div>
	<div id="annonces">
		<div class = "annonces1" id="annonce1">Football</div>
		<div class = "annonces1" id="annonce2">Tennis</div>
		<div class = "annonces1" id="annonce3">Rugby</div>
		<div class = "annonces1" id="annonce4">Basket</div>
		<div class = "annonces1" id="annonce5">Cyclisme</div>
		<div class = "annonces1" id="annonce6">Randonnée</div>
	</div>
	<div>
		<input type="submit" value="Voir tous les sports" class="bouton">
	</div>
	<?php if(connecte()) {  ?>
		<h2 class="titreClassique texteBase">Les annonces à la mode</h2>
		<div class="petitTitre texteBase">Choisissez un groupe dynamique avec des personnes motivées</div>
		<div id='annoncesMoment'>
			<div class="annonces2">
				
			</div>
			<div class="annonces2">
				
			</div>
		</div>
	<?php } ?>
