<div class="fond"></div>

<div>
	<h5 style="text-align: center ; font-size: 50px">
		<?php echo $recup_club['nom'] ?>
	</h5>
	<div>
	<div class="description">
		sport : 
		<?php
			$lists=(sportParId(sport_club($recup_club['id'])));
			foreach  ($lists as $list){
				echo $list[0];
			}
		 ?>
		<br>
		description <?php echo $recup_club['description']; ?>
	</div>
	<div class="image">
		<img src="static/images/gymnase.jpg" style="width: 100%" />
	</div>
	</div>
</div>