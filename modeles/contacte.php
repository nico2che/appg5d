<?php



function formulaire_contacte($nom,$email,$sujet,$contenu){
	global $pdo;

	$stmt = $pdo-> prepare('INSERT INTO contacte_message SET nom= :nom, email= :email, sujet= :sujet, contenu= :contenu');
	$stmt->bindValue('nom', $nom, PDO::PARAM_STR);
	$stmt->bindValue('email', $email, PDO::PARAM_STR);
	$stmt->bindValue('sujet', $sujet, PDO::PARAM_STR);
	$stmt->bindValue('contenu', $contenu, PDO::PARAM_STR);

	if($stmt->execute())
		return $pdo->lastInsertId();
	else
		return false;
}



