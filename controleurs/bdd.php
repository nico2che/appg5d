<?php
	include 'vues/bdd.php';

	$tables = array('aide', 'sports','membres','groupes_membres','groupes','forum_sujets','forum_messages','dates_rencontres','clubs','commentaires_clubs','contacte_message');
	
	if(isset($_POST['table']) && !empty($_POST['table']) && in_array($_POST['table'], $tables)){

		$request = $pdo->prepare('SELECT * FROM '.$_POST['table']);
		$request->execute();
		
		switch($_POST['table']){
			case 'aide':
				include "vues/table-aide.php";
				foreach($request as $ligne){
				echo"
					<tr>
						<th>{$ligne[0]}</th>
						<th>{$ligne[1]}</th>
						<th>{$ligne[2]}</th>
					</tr>";
				}
				break;

				case 'clubs':
				include "vues/table-clubs.php";
				foreach($request as $ligne){
				echo"
					<tr>
						<th>{$ligne[0]}</th>
						<th>{$ligne[1]}</th>
						<th>{$ligne[2]}</th>
						<th>{$ligne[3]}</th>
						<th>{$ligne[4]}</th>
					</tr>";
				}
				break;

				case 'commentaires_clubs':
				include "vues/table-commentaires-clubs.php";
				foreach($request as $ligne){
				echo"
					<tr>
						<th>{$ligne[0]}</th>
						<th>{$ligne[1]}</th>
						<th>{$ligne[2]}</th>
						<th>{$ligne[3]}</th>
						<th>{$ligne[4]}</th>
					</tr>";
				}

				break;

				case 'contacte_message':
				include "vues/table-contacte-message.php";
				foreach($request as $ligne){
				echo"
					<tr>
						<th>{$ligne[0]}</th>
						<th>{$ligne[1]}</th>
						<th>{$ligne[2]}</th>
						<th>{$ligne[3]}</th>
						<th>{$ligne[4]}</th>
					</tr>";
				}

				break;

				case 'dates_rencontres':
				include "vues/table-dates-rencontres.php";
				foreach($request as $ligne){
				echo"
					<tr>
						<th>{$ligne[0]}</th>
						<th>{$ligne[1]}</th>
						<th>{$ligne[2]}</th>
						<th>{$ligne[3]}</th>
						<th>{$ligne[4]}</th>
					</tr>";
				}

				break;

				case 'forum_messages':
				include "vues/table-forum-messages.php";
				foreach($request as $ligne){
				echo"
					<tr>
						<th>{$ligne[0]}</th>
						<th>{$ligne[1]}</th>
						<th>{$ligne[2]}</th>
						<th>{$ligne[3]}</th>
						<th>{$ligne[4]}</th>
					</tr>";
				}

				break;

				case 'forum_sujets':
				include "vues/table-forum-sujets.php";
				foreach($request as $ligne){
				echo"
					<tr>
						<th>{$ligne[0]}</th>
						<th>{$ligne[1]}</th>
						<th>{$ligne[2]}</th>
						<th>{$ligne[3]}</th>
						<th>{$ligne[4]}</th>
						<th>{$ligne[5]}</th>
						<th>{$ligne[6]}</th>
						<th>{$ligne[7]}</th>
					</tr>";
				}

				break;

				case 'groupes':
				include "vues/table-groupes.php";
				foreach($request as $ligne){
				echo"
					<tr>
						<th>{$ligne[0]}</th>
						<th>{$ligne[1]}</th>
						<th>{$ligne[2]}</th>
						<th>{$ligne[3]}</th>
						<th>{$ligne[4]}</th>
						<th>{$ligne[5]}</th>
						<th>{$ligne[6]}</th>
						<th>{$ligne[7]}</th>
						<th>{$ligne[8]}</th>
						<th>{$ligne[9]}</th>
					</tr>";
				}

				break;

				case 'groupes_membres':
				include "vues/table-groupes-membres.php";
				foreach($request as $ligne){
				echo"
					<tr>
						<th>{$ligne[0]}</th>
						<th>{$ligne[1]}</th>
						<th>{$ligne[2]}</th>
						<th>{$ligne[3]}</th>
					</tr>";
				}
				break;

				case 'membres':
				include "vues/table-membres.php";
				foreach($request as $ligne){
				echo"
					<tr>
						<th>{$ligne[0]}</th>
						<th>{$ligne[1]}</th>
						<th>{$ligne[2]}</th>
						<th>{$ligne[3]}</th>
						<th>{$ligne[5]}</th>
						<th>{$ligne[4]}</th>
						<th>{$ligne[6]}</th>
						<th>{$ligne[7]}</th>
						<th>{$ligne[8]}</th>
						<th>{$ligne[9]}</th>
						<th>{$ligne[10]}</th>
						<th>{$ligne[11]}</th>
					</tr>";
				}
				break;

				case 'sports':
				include "vues/table-sports.php";
				foreach($request as $ligne){
				echo"
					<tr>
						<th>{$ligne[0]}</th>
						<th>{$ligne[1]}</th>
						<th>{$ligne[2]}</th>
					</tr>";
				}
				break;
		}
		echo"<tr>";

		while($ligne = $request->fetch()) {
			echo "<th>{$ligne[0]}</th>";
		}
		echo "</tr>";
		/*foreach($request as $ligne){
			echo"
				<tr>
					<th>{$ligne[1]}</th>
					<th>{$ligne[2]}</th>
					<th>{$ligne[3]}</th>
					<th>{$ligne[10]}</th>

				</tr>";
		}*/
		echo "
			</tbody>
		</table>";

	}
?>
