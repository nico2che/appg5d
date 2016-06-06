<form method="post">
	<p style="margin-top: 10px;">Titre:</p>
	<textarea name="titre-aide" rows="1" cols="30"><?php 

	if(isset($_POST['titre-aide'])){
		echo "$_POST['titre-aide']";
	}else{
		echo "$ligne[1]";
	}

		?></textarea></br>
	<button type="submit">Envoyer</button>
</form>