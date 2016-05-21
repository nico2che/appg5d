<h2>Vous pouvez modifier le contenu du message</h2>
<form method="post">
	<textarea name="messageModifie" rows="10" cols="50"><?php if(isset($_POST['messageModifie'])){
		echo $_POST['messageModifie'];}else{echo $message['message'];} ?></textarea>
	<button type="submit">Envoyer</button>
</form>