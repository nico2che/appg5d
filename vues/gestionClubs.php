<table>
	<tr>
		<th>Nom</th>
		<th>Description</th>
		<th>Localisation</th>
		<th>Code postale</th>
		<th>Site</th>
		<th>Telephone</th>
		<th>Email</th>
		<th>ID departement</th>
		<th>Approuvé</th>
		<th>Action</th>
	</tr>
	<?php if(!empty($request)){
				foreach($request as $ligne){
					echo"<tr>
						<td>{$ligne[1]}</td>
						<td>{$ligne[2]}</td>
						<td>{$ligne[3]}</td>
						<td>{$ligne[4]}</td>
						<td>{$ligne[5]}</td>
						<td>{$ligne[6]}</td>
						<td>{$ligne[7]}</td>
						<td>{$ligne[8]}</td>
						<td>{$ligne[9]}</td>
						<td><form method=\"post\">Approuvé:</br><input type=\"radio\" name=\"approuve\" value=\"1\">Oui</input>
												  		   </br><input type=\"radio\" name=\"approuve\" value=\"0\">Non</input>
												  		   </br><input type=\"hidden\" name=\"club_id\" value=\"$ligne[0]\"></input>
												  		   <button type=\"submit\">Envoyer</button>
							</form>
						</tr>";
				}
			}		
	?>
	</table>