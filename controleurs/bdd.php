<?php
	include 'vues/bdd.php'; 
	$bdd = new PDO('mysql:host=localhost;dbname=app;charset=utf8','root', '');
	$request = $bdd->prepare('SELECT * FROM (table)');
	
	if(isset($_POST['table']) && !empty($_POST['table'])){
		$request->bindParam(':table', $_POST['table']);
		$request->execute();
		switch($_POST['table']){
			case 'aide':
				echo "
					<h1>Table sélectionnée:</h1>
						<table>
							<thead>
								<tr>
									<th>ID</th>
									<th>Titre</th>
									<th>Texte</th>
								</tr>
							</thead>
							<tbody>";
				break;

				case 'clubs':
				echo "
					<h1>Table sélectionnée:</h1>
						<table>
							<thead>
								<tr>
									<th>ID</th>
									<th>Nom</th>
									<th>Description</th>
								</tr>
							</thead>
							<tbody>";
				break;

				case 'commentaires_clubs':
				echo "
					<h1>Table sélectionnée:</h1>
						<table>
							<thead>
								<tr>
									<th>ID</th>
									<th>ID club</th>
									<th>ID membre</th>
									<th>Commentaire</th>
									<th>Note</th>
								</tr>
							</thead>
							<tbody>";
				break;

				case 'contact_message':
				echo "
					<h1>Table sélectionnée:</h1>
						<table>
							<thead>
								<tr>
									<th>ID</th>
									<th>Nom</th>
									<th>E-mail</th>
									<th>Sujet</th>
									<th>Contenu</th>
								</tr>
							</thead>
							<tbody>";
				break;

				case 'dates_rencontres':
				echo "
					<h1>Table sélectionnée:</h1>
						<table>
							<thead>
								<tr>
									<th>ID</th>
									<th>ID groupe</th>
									<th>Date</th>
									<th>Durée</th>
									<th>Localisation</th>
								</tr>
							</thead>
							<tbody>";
				break;

				case 'forum_messages':
				echo "
					<h1>Table sélectionnée:</h1>
						<table>
							<thead>
								<tr>
									<th>ID</th>
									<th>ID sujet</th>
									<th>ID membre</th>
									<th>Message</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>";
				break;

				case 'forum_sujets':
				echo "
					<h1>Table sélectionnée:</h1>
						<table>
							<thead>
								<tr>
									<th>ID</th>
									<th>ID membre</th>
									<th>Type</th>
									<th>ID sport</th>
									<th>Résolus</th>
									<th>Titre</th>
									<th>Message</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>";
				break;

				case 'groupes':
				echo "
					<h1>Table sélectionnée:</h1>
						<table>
							<thead>
								<tr>
									<th>ID</th>
									<th>Titre</th>
									<th>Description</th>
									<th>ID sport</th>
									<th>ID club</th>
									<th>Max participants</th>
									<th>Min participants</th>
									<th>Visibilitée</th>
									<th>Récurrence</th>
									<th>Niveau</th>
								</tr>
							</thead>
							<tbody>";
				break;

				case 'groupes_membres':
				echo "
					<h1>Table sélectionnée:</h1>
						<table>
							<thead>
								<tr>
									<th>ID</th>
									<th>ID groupe</th>
									<th>ID membre</th>
									<th>Type</th>
								</tr>
							</thead>
							<tbody>";
				break;

				case 'membres':
				echo "
					<h1>Table sélectionnée:</h1>
						<table>
							<thead>
								<tr>
									<th>ID</th>
									<th>Nom</th>
									<th>Prenom</th>
									<th>E-mail</th>
									<th>Mot de passe</th>
									<th>Description</th>
									<th>Date de naissance</th>
									<th>Localisation</th>
									<th>Sexe</th>
									<th>Bannis</th>
									<th>Role</th>
									<th>Activité forum</th>
								</tr>
							</thead>
							<tbody>";
				break;

				case 'sport':
				echo "
					<h1>Table sélectionnée:</h1>
						<table>
							<thead>
								<tr>
									<th>ID</th>
									<th>Nom</th>
									<th>Description</th>
								</tr>
							</thead>
							<tbody>";
				break;
		}
		

		foreach($request as $ligne){
			echo"
				<tr>
					<th>{$ligne[1]}</th>
					<th>{$ligne[2]}</th>
					<th>{$ligne[3]}</th>
					<th>{$ligne[10]}</th>

				</tr>";
		}
		echo "
			</tbody>
		</table>";

	}
?>
