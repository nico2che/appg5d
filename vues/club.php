<div class="fond"></div>

<div>
	<h5 style="text-align: center ; font-size: 50px">
		<?php echo $recup_club['nom'] ?>
	</h5>
	<div>
	<div class="description">
		ville : <?php echo $recup_club['localisation'].",".$recup_club['code_postale'] ; ?>
		<br>
		sport : 
		<?php
			$lists=(sportParId(sport_club($recup_club['id'])));
			foreach  ($lists as $list){
				echo $list[0];
				echo',';
			}
		 ?>
		
		<?php
			if ($recup_club['site']!=null) {
				echo "<br>";
				echo 'site : <a href="'.$recup_club['site'].'">'.$recup_club['site'].'</a>';
			}
			if ($recup_club['telephone']!=null) {
				echo "<br>";
				echo  'telephone :'.$recup_club['telephone'];
			}
			if ($recup_club['email']!=null) {
				echo "<br>";
				echo 'email :'.$recup_club['email'];
			}
		?>
		<br>
		description:
		<br>
		 <?php echo $recup_club['description']; ?>
	</div>
	<div class="image">
		<?php
		echo '<img src="'.$recup_club['photo_club'].'" style="width: 100%" />'
		?>
	</div>
	</div>
</div>

<div>
	note :
	<?php
	echo moyenne($recup_commentaires);
	?>/5
	<br>
	commentaires : 
	<br>
	<div>
		<?php

			foreach ($recup_commentaires as $commentaire) {
				echo '<table>
				<tr>
					<td>'.nomPrenom($commentaire[2])[0].'<br>'.nomPrenom($commentaire[2])[1].'</td>
					<td>'.$commentaire[3].'</td>
					<td>'.$commentaire[4].'/5</td>
				</tr>
				</table>';
				echo '<br>';
			}
			
		?>
	</div>
</div>

<div>
	<?php if (connecte()){ ?>
	<form method="post">
		<label for="commentaire">commentaire :</label>
        	<textarea name="conntenuMessageComment"></textarea>  
        	<select name="note">
        		<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
		<input type="submit" value="envoyer"></input>
	</form>
	<?php }?>
</div>