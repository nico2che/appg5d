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
		<th>Activite forum</th>
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
					<td>{$ligne[8]}</td>
					<td>{$ligne[9]}</td>
					<td>{$ligne[10]}</td>
					<td>{$ligne[11]}</td>
				</tr></table>
			";
	}