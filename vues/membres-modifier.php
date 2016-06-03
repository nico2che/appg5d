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
					$_SESSION['membre_id']=$ligne[0];
					echo"<tr>
						<td>{$ligne[0]}</td>
						<td>{$ligne[1]}</td>
						<td>{$ligne[2]}</td>
						<td>{$ligne[3]}</td>
						<td>{$ligne[4]}</td>
						<td>{$ligne[6]}</td>
						<td>{$ligne[7]}</td>
						<td>{$ligne[8]}</td>
						<td>{$ligne[9]}</td>
						<td>{$ligne[10]}</td>
						<td>{$ligne[11]}</td>
						</tr>";
				}
			}		
	?>
	</table>
	</br><form method="post">
	<table>
		<tr>
			<th>Bannir</th>
			<th>Role</th>
		</tr>
		<tr>	
			<td>
				<input type="radio" name="bannis" value="1">Oui</input></br>
		    	<input type="radio" name="bannis" value="0">Non</input></br>
		    </td>
		       	
			<td>
				<input type="radio" name="role" value="admin">admin</input></br>
		    	<input type="radio" name="role" value="membre">membre</input></br>
		    </td>
		    <td><input type="submit" name=""></td>
		</tr>       
	</table>
	<input type="hidden" value="<?php echo $_SESSION['membre_id'] ?>"></input>
	</form>	       