<div class="fond"></div>
<div>
	<div class="title"><strong>Club</strong></div>
	
	<br>
	<div class="recherche">
		<br>
		Recherche : 
		<br>
		<form method='post'>
			<label for="sport">Sport :</label>
			<select id="sport" name="sport">
				<option value="0">Choisissez un sport</option>
				<?php 
				foreach ($sports as $sport) {
					echo '<option value="'.$sport['id'].'"'.(isset($_POST['sport']) && $_POST['sport'] == $sport['id'] ? ' selected=""' : null).'>'.$sport['nom'].'</option>';
				}	
				?>

			</select>
			Departement :
			<select name="departement">
				<option value="0">Choisissez un departement</option>
				<?php

				foreach ($departements as $departement) {
					echo '<option value="'.$departement['departement_id'].'"'.(isset($_POST['departement']) && $_POST['departement'] == $departement['departement_id'] ? ' selected=""' : null).'>'.$departement['departement_nom'].'</option>';
				}
				?>
			</select>
			<input type="submit" value="rechercher"></input>
		</form>

	</div>
	<div>
		<?php 
			foreach  ($L_clubs as $L_club){
			echo '<div class="bordure">
			<a href="?page=club&amp;id='.$L_club[0].'">
			'.$L_club[1].'
			<br>
			'.$L_club[4].'
			<img src="'.$L_club[3].'" style="width: 80%","height=20px">
			</a>
			</div>';
		}
		?>
		 

				
				
			
	</div>
</div>
