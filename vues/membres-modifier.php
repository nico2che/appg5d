<table>
	<tr>
		<th>ID</th>
		<th>Pseudo</th>
		<th>Nom</th>
		<th>Prenom</th>
		<th>email</th>
		<th>Description</th>
		<th>Date de naissance</th>
		<th>Localisation</th>
		<th>Sexe</th>
		<th>Bannis</th>
		<th>Role</th>
	</tr>
	<?php if(!empty($request)){
				foreach($request as $ligne){
				echo"<tr>
						<td>{$ligne[0]}</td>
						<td>{$ligne[1]}</td>
						<td>{$ligne[2]}</td>
						<td>{$ligne[3]}</td>
						<td>{$ligne[4]}</td>
						<td>{$ligne[6]}</td>
						<td>{$ligne[7]}</td>
						<td>{$ligne[8]}</td>
						<td>{$ligne[9]}</td>";
						if($ligne[10]==0){
							echo"<td><form method=\"post\"><select name=\"bannis\"><option selected=\"selected\" value=\"0\">0</option><option value=\"1\">1</option></select><button type=\"submit\">envoyer</button></form></td>";
						}else{
							echo"<td><form method=\"post\"><select name=\"bannis\"><option value=\"0\">0</option><option selected=\"selected\" value=\"1\">1</option></select><button type=\"submit\">envoyer</button></form></td>";
						}

						if($ligne[11]=='membre'){
							echo"<td><form method=\"post\"><select name=\"role\"><option selected=\"selected\">membre</option><option>admin</option></select><button type=\"submit\">envoyer</button></form></td>";
						}else{
							echo"<td><form method=\"post\"><select name=\"role\"><option>membre</option><option selected=\"selected\">admin</option></select><button type=\"submit\">envoyer</button></form></td>";
						}

						echo"</tr></table>";
		}		
	}else{
		echo"</table>";
	}
	?>