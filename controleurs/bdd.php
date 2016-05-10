<h1>Bienvenue sur votre espace d'administration</h1>
<p> Ici, vous pouvez modifier la base de donnée, cela aura un effet direct sur le site. 
Vous devez tout d'abord selectionner une table à modifier, puis le nom de la colonne à modifier.</p></br>
<p>Choisissez la table: 
<form>
<select name="table" method="post" size="1">
<option>aide
<option>clubs
<option>commentaires_clubs
<option>contacte_message
<option>dates_rencontres
<option>forum_messages
<option>forum_sujets
<option>groupes
<option>groupes_membres
<option>membres
<option>sports
</select>
</form>
</p>
<h1><?php if(isset($_POST['table'])){
			$_POST['table'];
		}
	?></h1>
<table>
			<thead>
				<tr>
					<th>Nom</th>
					<th>Prenom</th>
					<th>Email</th>
					<th>Rôle</th>
				</tr>
			</thead>
			<tbody>
<?php 
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