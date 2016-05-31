	<div id="cover"></div>
	<h1><a href="?page=forum">Forum</a></h1>
	<h3><a href="?page=forum&amp;sport=<?php echo $id_sport; ?>"><?php echo $sport['nom']; ?></a></h3>
<?php if(connecte()) {  ?>
	<p><a href="?page=forum&amp;ajouter&amp;sport=<?php echo $id_sport; ?>" class="bouton b-principal ajouter-sujet">Ajouter un sujet</a><br></p>
<?php } ?>
	<table>
		<thead>
			<tr>
				<th style="width:50%;">Sujets</th>
				<th>Auteur</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>
		<?php
			if(!empty($sujets_sport)) {

				foreach ($sujets_sport as $sujet) {

					$date = new DateTimeFrench($sujet['date']);
		?>
			<tr><td><a href="?page=forum&amp;sujet=<?php echo $sujet['id_sujet']; ?>"><?php echo $sujet['titre']; ?></a></td><td><?php echo $sujet['prenom']; ?> <?php echo $sujet['nom']; ?></td><td><?php echo $date->format('H\hi \l\e d F Y'); ?></td></tr>
		<?php
				}

			} else {
		?>
			<tr><td colspan="3">Aucun sujet pour ce sport</td></tr>
		<?php
			}
		?>
		</tbody>
	</table>