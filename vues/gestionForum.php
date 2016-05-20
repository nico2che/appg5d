<table>
	<tr>
		<th>Date et Heure</th>
		<th>Membre</th>
		<th>Contenu</th>
		<th>Action</th>
	</tr>
	<?php foreach($request as $ligne){
				echo"<tr>
					<td>{$ligne[4]}</td>
					<td>{$ligne[2]}</td>
					<td>{$ligne[3]}</td>
					<td><a href=\"?page=bdd&gestion-forum&mid=$ligne[0]\">Modifier</a> <a href=\"?page=bdd&gestion-forum&sid=$ligne[0]\">Supprimer</a></td>
				</tr>";
		} ?>
</table>

