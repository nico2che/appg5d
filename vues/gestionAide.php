<table>
	<tr>
		<th>Titre</th>
		<th>Texte</th>
		<th>Action</th>
	</tr>
	<?php if(!empty($request)){
				foreach($request as $ligne){
					echo"<tr><td>";
					
					if(isset($_POST['titre-aide']) && $ligne[0]==$_GET['id']){
						echo $_POST['titre-aide'];
					}else{
						echo $ligne[1];
					}
						echo"</td>
						<td>";
					
					if(isset($_POST['texte-aide'])&& $ligne[0]==$_GET['id']){
						echo $_POST['texte-aide'];
					}else{
						echo $ligne[2];
					}
						echo "</td><td><a href=\"?page=bdd&gestion-aide&mod-titre&id=$ligne[0]\">Modifier le titre</a>
							</br><a href=\"?page=bdd&gestion-aide&mod-texte&id=$ligne[0]\">Modifier texte</a>
						</td>
						</tr>";
				}
			}
	?>
</table>