<div id="cover"></div>
<h1>Forum</h1>
<div class="forum">
	
	<?php if(connecte()) {  ?>
	<a href="?page=forum&amp;ajouter" class="ajouter-sujet">Ajouter un sujet</a>
	<?php } ?>
	<div class="titre">
		<h3 class="texteTitre1">Aide</h3>
		<h3 class="texteTitre2">Topics</h3>
		<h3 class="texteTitre3" >Posts</h3>
		<h3 class="texteTitre4" >Dates</h3>


	</div>
	<div class="sujets">
		<ul>
			<li><a href="?page=forum&amp;sujet="><span class="date">Date</span><span class="nom">Nom du sujet</span></a></li>
			<li><a href="?page=forum&amp;sujet="><span class="date">Date</span><span class="nom">Nom du sujet</span></a></li>
			<li><a href="?page=forum&amp;sujet="><span class="date">Date</span><span class="nom">Nom du sujet</span></a></li>
		</ul>
	</div>
	<div class="titre">
		<h3>Sports</h3>
	</div>
	
	<div class="sujets">
		<ul>
		<?php 
			foreach ($sports as $sport) {
		?>
			<li><a href="?page=forum&amp;sujet="><span class="date">Date</span><span class="nom"><?php echo $sport['nom']; ?></span></a></li>
		<?php
			}
		?>
		</ul>
	</div>
</div>
