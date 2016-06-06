<form method="post">
	<p style="margin-top: 10px;">Texte:</p>
	
	<textarea name="texte-aide" rows="3" cols="60"><?php 
	
	if(isset($_POST['texte-aide'])){
		echo $_POST['texte-aide'];
	}else{
		echo $ligne[2];
	}
	?>
			
	</textarea></br>
	<button type="submit">Envoyer</button>
</form>