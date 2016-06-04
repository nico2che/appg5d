<a href="?page=bdd&gestion-forum">Gérer les messages du forum</a>

<table>
	<tr>
		<th>Titre</th>
		<th>Type</th>
		<th>Résolus</th>
		<th>Action</th>
	</tr>
	<?php foreach($request as $ligne){
					echo"
					<tr>
						<td>{$ligne[5]}</td>
						<td>{$ligne[2]}</td>
						<td>{$ligne[4]}</td>
						<td><form method=\"post\">Résolus: </br>oui<input type=\"radio\" name=\"rseolus\" value=\"1\"></input>
														   </br>non<input type=\"radio\" name=\"resolus\" value=\"0\"></input>
														   <input type=\"hidden\" name=\"id_sujet\" value=\"$ligne[0]\"></input>
														   </br><button type=\"submit\">Envoyer</button>
							</form>
						</td>
					</tr>";		
				}
				
	 ?>
</table>