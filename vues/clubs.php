<div class="fond"></div>
<div>
	Club
	<div>
		<?php 
			foreach  ($L_clubs as $L_club){
			echo '<div class="bordure">
			<a href="?page=club&amp;id='.$L_club[0].'">
			'.$L_club[1].'
			<br>
			'.$L_club[4].'
			<img src="'.$L_club[3].'" style="width: 100%">
			</a>
			</div>';
		}
		?>
		 

				
				
			
	</div>
</div>
