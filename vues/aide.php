<div id="cadreP" class="red-hover">
<?php
	foreach($aides as $aide) {
?>
	<div>
		<a href="#" id="menu1" onclick="affichage('a' + <?php echo $aide['id']; ?>)" ><h3 class="onglet"><?php echo $aide['titre']; ?></h3></a>
	</div>

<?php
	}
?>
</div>

<div class="box grad">
	<div>
		<h2 class="Title">Foire aux Questions</h2>
	</div>
	<div id="cadre">
<?php
	foreach($aides as $aide) {
?>
		<div class="rubrique" id="a<?php echo $aide['id']; ?>">
			<h3 ><?php echo $aide['titre']; ?></h3>
			<p><?php echo $aide['texte']; ?></p>
			<img class="logo" src="static/images/logoteam-up.png" height= "60px">
		</div>
<?php
	}
?>
	</div>
</div>