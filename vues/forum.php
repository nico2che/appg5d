<<<<<<< HEAD
<h1>Forum</h1>
<form id="searchbox" action="">
	<input id="search" type="text" placeholder="Type here">
	<input id="submit" type="submit" value="Search">
</form>
<p><img src = "static/images/aideicone.png" width="40" height="40" >Aide en ligne</p>
=======
<div class="forum">
	<h1>Forum</h1>
	<a href="?page=forum&amp;ajouter" class="ajouter-sujet">Ajouter un sujet</a>
	<h3>Aide</h3>
	<div class="sujets">
		<ul>
			<li><a href="?page=forum&amp;sujet="><span class="date">Date</span><span class="nom">Nom du sujet</span></a></li>
			<li><a href="?page=forum&amp;sujet="><span class="date">Date</span><span class="nom">Nom du sujet</span></a></li>
			<li><a href="?page=forum&amp;sujet="><span class="date">Date</span><span class="nom">Nom du sujet</span></a></li>
		</ul>
	</div>
	<h3>Sports</h3>
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
>>>>>>> origin/master
