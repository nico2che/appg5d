<div id="cover"></div>
<h1><a href="?page=forum">Forum</a></h1>
<?php if(connecte()) {  ?>
	<a href="?page=forum&amp;ajouter" class="bouton b-principal ajouter-sujet">Ajouter un sujet</a>
<?php } ?>
<div class="forum">
	<table>
		<thead>
			<tr>
				<th style="width:50%;">Aide</th>
				<th>Auteur</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($sujets_aide as $sujet) {
					$date = new DateTimeFrench($sujet['date']);
			?>
				<tr><td><a href="?page=forum&amp;sujet=<?php echo $sujet['id_sujet']; ?>"><?php echo $sujet['titre']; ?></a></td><td><?php echo $sujet['prenom']; ?> <?php echo $sujet['nom']; ?></td><td><?php echo $date->format('H\hi \l\e d F Y'); ?></td></tr>
			<?php
				}
			?>
		</tbody>
	</table>
	<table>
		<thead>
			<tr>
				<th>Sport</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($sports as $sport) {
			?>
				<tr><td><a href="?page=forum&amp;sport=<?php echo $sport['id']; ?>"><?php echo $sport['nom']; ?></a></td></tr>
			<?php
				}
			?>
		</tbody>
	</table>
</div>
