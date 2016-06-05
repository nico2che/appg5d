<?php
	include 'vues/admin-menu.php';
	include 'modeles/admin.php';

	$tables = array('aide', 'sports','membres','groupes_membres','groupes','forum_sujets','forum_messages','dates_rencontres','clubs','commentaires_clubs','contacte_message','sport_club');
	
	echo"<p>Ici, vous  pouvez gérer votre site web, en cliquant sur un onglet du menu de gauche,
	vous aurez accès à de nombreuses fonctionnalitées!";
	



	if(isset($_GET['gestion-bdd'])){
		?><div class="cadre-gestion"><?php
		include 'vues/gestionBDD.php';
		?></div><?php
	}
	


	if(isset($_GET['gestion-clubs'])){
		$request = $pdo->query('SELECT * FROM clubs WHERE approuve=0');
		if(empty($request)){
			echo"</br><h2 style=\"text-align:center\">Pas de clubs non aprouvés!</h2>";
		}else{
			
			?><div class="cadre-gestion"><?php
			include 'vues/gestionClubs.php';
			?></div><?php
			if(isset($_POST['approuve']) && isset($_POST['club_id'])){
				$request=$pdo->prepare('UPDATE clubs SET approuve =? WHERE id=?');
				$param4 = array($_POST['approuve'], $_POST['club_id']);
				$request->execute($param4);
			}
			}
			
		

	}


	if(isset($_GET['gestion-forum'])){
		
		if(isset($_GET['sujet'])){
			$request1 = $pdo->query('SELECT * FROM forum_sujets');
			?><div class="cadre-gestion"><?php
			include 'vues/gestionSujets.php';
			?></div><?php
		}else{
			$request = $pdo->query('SELECT * FROM forum_messages');
			?><div class="cadre-gestion"><?php
			include 'vues/gestionForum.php';
			?></div><?php
		}
		

		if(isset($_POST['resolus'])){
			$request=$pdo->prepare('UPDATE forum_sujets SET resolu =? WHERE id=?');
			$param3 = array($_POST['resolus'], $_POST['id_sujet']);
			$request->execute($param3);
		}
		
		
		if(isset($_GET['mid'])){
			$request = $pdo -> prepare('SELECT message FROM forum_messages WHERE id=?');
			$param = array($_GET['mid']);
			$request->execute($param);
			$message = $request->fetch();
			?><div class="cadre-gestion"><?php
			include 'vues/bdd-modifier.php';
			?></div><?php
			if(isset($_POST['messageModifie'])){
				$request = $pdo -> prepare('UPDATE forum_messages SET message =? WHERE id=?');
				$param2 = array($_POST['messageModifie'], $_GET['mid']);
				$request->execute($param2);
			}
		}


		if(isset($_GET['sid'])){
			$request = $pdo -> prepare('DELETE FROM forum_messages WHERE id=?');
			$param3 = array($_GET['sid']);
			$request -> execute($param3);
		}
	}
	

	if(isset($_GET['gestion-nl'])){
		?><div class="cadre-gestion"><?php
		include 'vues/gestionNL.php';
		?></div><?php
		if(isset($_POST['newsLetter'])){
			mail_to_members($_POST['newsLetter']);
		}
		
	}
	

	

	if(isset($_GET['gestion-membres'])){
		?><div class="cadre-gestion"><?php
		include 'vues/gestionMembres.php';
		?></div><?php

		if(isset($_POST['pseudo']) && !empty($_POST['pseudo'])){
			$request=$pdo->query("SELECT * FROM membres WHERE pseudo='".$_POST['pseudo']."'");
			?><div class="cadre-gestion"><?php
			include 'vues/membres-modifier.php';
			?></div><?php
			

		}
		if(isset($_POST['bannis'])){
				$request=$pdo->query("UPDATE membres SET bannis='".$_POST['bannis']."' WHERE id='".$_SESSION['membre_id']."'");

			}

		if(isset($_POST['role'])){
			echo $_POST['role'];
				$request=$pdo->query("UPDATE membres SET role='".$_POST['role']."' WHERE id='".$_SESSION['membre_id']."'");

			}	

	}



	
	if(isset($_POST['table']) && !empty($_POST['table']) && in_array($_POST['table'], $tables)){

		$request = $pdo->prepare('SELECT * FROM '.$_POST['table']);
		$request->execute();
		
		switch($_POST['table']){
			case 'aide':
			?><div class="cadre-gestion"><?php
				include "vues/table-aide.php";
				?></div><?php
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
				?><div class="cadre-gestion"><?php
				include "vues/table-clubs.php";
				?></div><?php
				foreach($request as $ligne){
				echo"
					<tr>
						<th>{$ligne[0]}</th>
						<th>{$ligne[1]}</th>
						<th>{$ligne[2]}</th>
						<th>{$ligne[4]}</th>
						<th>{$ligne[5]}</th>
						<th>{$ligne[6]}</th>
						<th>{$ligne[7]}</th>
						<th>{$ligne[8]}</th>
					</tr>";
				}
				break;

				case 'commentaires_clubs':
				?><div class="cadre-gestion"><?php
				include "vues/table-commentaires-clubs.php";
				?></div><?php
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
				?><div class="cadre-gestion"><?php
				include "vues/table-contacte-message.php";
				?></div><?php
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
				?><div class="cadre-gestion"><?php
				include "vues/table-dates-rencontres.php";
				?></div><?php
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
				?><div class="cadre-gestion"><?php
				include "vues/table-forum-messages.php";
				?></div><?php
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
				?><div class="cadre-gestion"><?php
				include "vues/table-forum-sujets.php";
				?></div><?php
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
				?><div class="cadre-gestion"><?php
				include "vues/table-groupes.php";
				?></div><?php
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
				?><div class="cadre-gestion"><?php
				include "vues/table-groupes-membres.php";
				?></div><?php
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
				?><div class="cadre-gestion"><?php
				include "vues/table-membres.php";
				?></div><?php
				foreach($request as $ligne){
				echo"
					<tr>
						<th>{$ligne[0]}</th>
						<th>{$ligne[1]}</th>
						<th>{$ligne[2]}</th>
						<th>{$ligne[3]}</th>
						<th>{$ligne[5]}</th>
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
				?><div class="cadre-gestion"><?php
				include "vues/table-sports.php";
				?></div><?php
				foreach($request as $ligne){
				echo"
					<tr>
						<th>{$ligne[0]}</th>
						<th>{$ligne[1]}</th>
						<th>{$ligne[2]}</th>
					</tr>";
				}
				break;

				case 'sport_club':
				?><div class="cadre-gestion"><?php
				include "vues/table-sport_club.php";
				?></div><?php
				foreach($request as $ligne){
				echo"
					<tr>
						<th>{$ligne[0]}</th>
						<th>{$ligne[1]}</th>
					</tr>";
				}
				break;


		}
		echo"<tr>";

		while($ligne = $request->fetch()) {
			echo "<th>{$ligne[0]}</th>";
		}
		echo "</tr>";
		echo "
			</tbody>
		</table>";

	}
?>
