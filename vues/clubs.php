<div class="fond"></div>
<div>
	Club
	<div>
		<?php 
			//var_dump($L_clubs);
			foreach  ($L_clubs as $L_club){
			echo '<div class="bordure">
			<a href="?page=club&amp;id='.$L_club[0].'">
			'.$L_club[1].'
			<br>
			'.$L_club[2].'
			</a>
			</div>';
		}
		?>
		 

				
				
			
	</div>
</div>
