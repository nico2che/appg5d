<table>
	<tr>
		<th>Titre</th>
		<th>Texte</th>
		<th>Action</th>
	</tr>
	<?php if(!empty($request)){
				foreach($request as $ligne){
					echo"<tr>
						<td>{$ligne[1]}</td>
						<td>{$ligne[2]}</td>
						<td><a href=\"?page=bdd&gestion-aide&mod-titre\">Modifier le titre</a>
							</br><a href=\"?page=bdd&gestion-aide&mod-texte\">Modifier texte</a>
						</td>
						</tr>";
				}
			}
	?>
</table>