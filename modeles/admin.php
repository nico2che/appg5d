<?php 

	function connexion_membre($email, $mot_de_passe) {

		global $pdo;
		$stmt = $pdo->prepare('SELECT * FROM membres WHERE email = :email AND mot_de_passe = :mot_de_passe');
		$stmt->bindValue('email', $email, PDO::PARAM_STR);
			$stmt->bindValue('mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
		if($stmt->execute())
			return $stmt->fetch();
		else
			return false;
}

?>