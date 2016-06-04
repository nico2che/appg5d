<a href="?page=bdd&gestion-forum&sujets">Gérer les sujets du forum</a>

<table>
	<tr>
		<th>Date et Heure</th>
		<th>Membre</th>
		<th>Contenu</th>
		<th>Action</th>
	</tr>
	<?php foreach($request as $ligne){
				if(isset($_GET['sid']) && $_GET['sid']==$ligne[0]){
				}else{
					echo"<tr>
					<td>{$ligne[4]}</td>
					<td>{$ligne[2]}</td>
					<td>";if(isset($_POST['messageModifie']) && $ligne[0]==$_GET['mid']){
							echo $_POST['messageModifie']."</td>";

						  }else{
						  	echo "{$ligne[3]}</td>";
						  }
						echo "<td><a href=\"?page=bdd&gestion-forum&mid=$ligne[0]\">Modifier</a> <a href=\"?page=bdd&gestion-forum&sid=$ligne[0]\">Supprimer</a></td>
				</tr>";
				}
				
		} ?>
</table>

