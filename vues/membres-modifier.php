<table>
	<tr>
		<th>ID</th>
		<th>Nom</th>
		<th>Prenom</th>
		<th>email</th>
		<th>Description</th>
		<th>Date de naissance</th>
		<th>Localisation</th>
		<th>Sexe</th>
		<th>Bannis</th>
		<th>Role</th>
		<th>Activité forum</th>
	</tr>
	<?php foreach($request as $ligne){
			echo"<tr>
					<td>{$ligne[0]}</td>
					<td>{$ligne[1]}</td>
					<td>{$ligne[2]}</td>
					<td>{$ligne[3]}</td>
					<td>{$ligne[5]}</td>
					<td>{$ligne[6]}</td>
					<td>{$ligne[7]}</td>
					<td>{$ligne[8]}</td>";
					if($ligne[9]==0){
						echo"<td><form method=\"post\" action=\"bdd.php\"><select name=\"bannis\"><option selected=\"selected\">0</option><option>1</option></td>";
					}else{
						echo"<td><form method=\"post\" action=\"bdd.php\"><select name=\"bannis\"><option>0</option><optionselected=\"selected\">1</option></td>";
					}

					if($ligne[10]=='membre'){
						echo"<td><form method=\"post\"><select name=\"role\"><option selected=\"selected\">membre</option><option>admin</option></td>";
					}else{
						echo"<td><form method=\"post\"><select name=\"role\"><option>membre</option><optionselected=\"selected\">admin</option></td>";
					}

					echo"<td>{$ligne[11]}</td>
				</tr></table>";
			
	}
	?>