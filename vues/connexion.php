	<form action="" method="post">
		<h2>Connexion</h2>
		<?php if(isset($message)) echo $message; ?>
		<div>
			<label>Email : </label>
			<input type="text" name="email">
		</div>
		<div>
			<label>Mot de passe : </label>
			<input type="password" name="mot_de_passe">
		</div>
		<div>
			<input type="submit">
		</div>
	</form>