	<div class="profil gauche">
		<img src="static/images/profil.jpg" class="photo">
		<div class="navigation">
			<ul>
				<li><a href="?page=mon-profil">Mon Profil</a></li>
				<li><a href="?page=mon-planning">Mon Planning</a></li>
				<li><a href="?page=mes-groupes">Mes Groupes</a></li>
			</ul>
		</div>
	</div>
	<div class="profil droite">
		<h2>Mon Planning</h2>
		<h3 class="align-center"><a href="#" class="mois-precedent"><<</a> &nbsp; <a href="#" class="mois-zero"><span class="titre-mois"><?php echo $calendrier->format('F Y'); ?></span></a> &nbsp; <a href="#" class="mois-suivant">>></a></h3>
		<table class="planning">
			<thead>
				<tr>
					<th>Lundi</th>
					<th>Mardi</th>
					<th>Mercredi</th>
					<th>Jeudi</th>
					<th>Vendredi</th>
					<th>Samedi</th>
					<th>Dimanche</th>
				</tr>
			</thead>
			<tbody class="detail">
				<tr>
			<?php
				for ($i=0; $i < $nombre_jours; $i++) {
					if($calendrier->format('j') == 1)
						echo '<td class="sans-bordure" colspan="'.$calendrier->format('N').'"></td>';
					echo '<td>' . $calendrier->format('j') . '</td>';
					$calendrier->add(new DateInterval('P1D'));
					if($calendrier->format('N') == 7)
						echo '</tr><tr>';
				}
			?>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="clear"></div>