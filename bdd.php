<?php
if(isset($_POST['m'])) {
	if(!is_file('app.sql'))
		exit("Impossible de trouver le fichier app.sql pour mettre a jour la base de donnees.<br>Rien a ete modifie");
	include 'init.php';
	$tables = $pdo->query('SHOW tables');
	while($l = $tables->fetch()) {
		$pdo->query('DROP TABLE '.$l[0]);
	}
	$dump = file('app.sql');
	$requete = '';
	foreach ($dump as $ligne) {
		if(substr($ligne, 0, 2) == '--' || $ligne == '')
		    continue;
		$requete .= $ligne;
		if(substr(trim($ligne), -1, 1) == ';') {
			$pdo->query($requete);
			if($pdo->errorInfo() != null && $pdo->errorInfo()[0] != '00000') {
				var_export($pdo->errorInfo());
				exit("Erreur lors du traitement de la mise a jour, veuillez ressayer");
			}
			$requete = '';
		}
	}
	echo "MAJ OKLM";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>MAJ BDD</title>
</head>
<body>
<form method="post">
	<p>Voulez-vous mettre a jour la base de donnees ?</p>
	<input type="submit" name="m" value="OUI !">
</form>
</body>
</html>