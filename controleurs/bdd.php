<?php
	include 'vues/bdd.php'; 
	$bdd = new PDO('mysql:host=localhost;dbname=app;charset=utf8','root', '');
	$request = $bdd->query('SELECT * FROM membres');
	
	foreach($request as $ligne){
		echo"
			<tr>
				<th>{$ligne[1]}</th>
				<th>{$ligne[2]}</th>
				<th>{$ligne[3]}</th>
				<th>{$ligne[10]}</th>

			</tr>";
	}
?>
</tbody>
</table>