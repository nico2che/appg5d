<form method="post">
	<p style="margin-top: 10px;">Titre:</p>
	
	<input type="text" name="titre-aide"<?php 
	
	echo "value=";
	if(isset($_POST['titre-aide'])){
		echo $_POST['titre-aide'];
	}else{
		echo $ligne[1];
	}
	?>>
			
	</input></br>
	<button type="submit">Envoyer</button>
</form>