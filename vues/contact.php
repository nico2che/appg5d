	<form class="box" method="post" >
		<h2>Contact</h2>
		<p>Pour nous contacter, veuillez remplir le formulaire si dessous. Nous vous répondrons dans les plus brefs délais.</p>
		<div  class="Formulaire">
		<?php if(isset($message1)) echo $message1; ?>
		<?php if(isset($message2)) echo $message2; ?>
			<div class="blocGauche">
			<div class="label1">
				<label for="nom">Nom :</label>
	       		<input type="text" name="userName" />
			</div>
			<div class="label1">
				<label for="Email" id="Email">Email :</label>
	        	<input type="text" name="userEmail" />
			</div>
			<div class="label1">
				<label for="Sujet" id="Sujet">Sujet :</label>
	        	<input type="text" name="Sujet" />
			</div>
			</div>
			<div class="blocDroite">
				<label for="Message">Message :</label>
        		<textarea id="tailleMessage" name="conntenuMessage"></textarea>  
			</div>
			<div  id="captcha">
				<div class="g-recaptcha" data-sitekey="6Ld-8h4TAAAAAFvrs6bAWoLKRZ7mwmxmlyTvN4CO">
				</div>
			</div>
			<input type="submit" value="envoyer" class="envoyer"></input>
		</div>
	</form>	
	<script src="https://www.google.com/recaptcha/api.js"></script>