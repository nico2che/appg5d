	<div id="cover"></div>
	<div class="slogan">La Passion se partage</div>
	<form class="accueil">
	</form>
	<div class="fond"></div>
	<div class="Promo texteBase">
		<h2>Rejoignez notre communauté simplement !</h2>
		<table>
			<tr>
				<td>
					<img src="static/images/souris.png" width="200" height="300" >
				</td>
				<td>
					<img src="static/images/highfive.png" width="200" height="300">
				</td>
				<td>
					<img src="static/images/vetements.png" width="200" height="200">
				</td>
			</tr>
		</table>
	</div>
	<h2 class="titreImage texteBase">Nos sports</h2>
	<div class="petitTitre texteBase">Découvrez un grand choix de sport à pratiquer entre amis</div>
	<div id="annonces">
		<div class = "annonces1" id="annonce1">Football</div>
		<div class = "annonces1" id="annonce2">Tennis</div>
		<div class = "annonces1" id="annonce3">Rugby</div>
		<div class = "annonces1" id="annonce4">Basket</div>
		<div class = "annonces1" id="annonce5">Cyclisme</div>
		<div class = "annonces1" id="annonce6">Randonnée</div>
		<div class = "annonces1" id="annonce7">Golf</div>
		<div class = "annonces1" id="annonce8">Atlétisme</div>
		<div class = "annonces1" id="annonce9">Voile</div>
		<div class = "annonces1" id="annonce10">Ping-Pong</div>
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
