<div class="forum-formulaire">
<?php
	if(isset($sujet)) {

		if(!empty($sujet) && connecte() && $sujet['id_membre'] == $_SESSION['id']) {

?>
	<h3>Modifier un sujet</h3>
	<form method="post" action="">
		<label>Nom du sujet * : </label><input type="text" name="titre" required="" value="<?php echo htmlspecialchars($sujet['titre']); ?>"><br>
		<label>Contenu * : </label>
		<textarea name="contenu" rows="15" cols="100" required=""><?php echo htmlspecialchars($sujet['message']); ?></textarea><br>
		<input type="submit" class="float-right" value="Modifier le sujet">
	</form>
<?php

		} else {
?>
	<div class="message erreur">
		Ce sujet n'existe pas ou plus.
	</div>
<?php
		}
?>
<?php } else { ?>
	<h3>Ajouter un sujet</h3>
	<form method="post" action="">
		<label>Nom du sujet * : </label><input type="text" name="titre" required=""><br>
		<label>Contenu * : </label>
		<textarea name="contenu" rows="15" cols="100" required=""></textarea><br>
		<input type="submit" class="float-right" value="Créer le sujet">
	</form>
<?php }	?>
</div>