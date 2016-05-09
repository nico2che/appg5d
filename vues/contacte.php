<div class="fond"></div>

<div style="text-align: center;">
	<?php if(isset($message1)) echo $message1; ?>
	<?php if(isset($message2)) echo $message2; ?>
	<form method="post">
			
		<div>
			<label for="nom">Nom :</label>
       		<input type="text" name="userName" />
		</div>

		<br>

		<div>
			<label for="Email" id="Email">Email :</label>
        	<input type="text" name="userEmail" />
		</div>

		<br>

		<div>
			<label for="Sujet" id="Sujet">Sujet :</label>
        	<input type="text" name="Sujet" />
		</div>

		<br>

		<div>
			<label for="Message">Message :</label>
			<br>
        	<textarea id="tailleMessage" name="conntenuMessage"></textarea>  
		</div>

		<br>
		
		<div  id="captcha"><div class="g-recaptcha" data-sitekey="6Ld-8h4TAAAAAFvrs6bAWoLKRZ7mwmxmlyTvN4CO"></div></div>

		<br>

		<input type="submit" value="envoyer"></input>

		


		
		
	</form>	

</div>


	
