var chargement = false, timeout;
ready(function(){
    Array.prototype.forEach.call(document.querySelectorAll('.inputs.recherche-simple select'), function(a, i){
        a.addEventListener('change', chargerGroupes);
    });
    Array.prototype.forEach.call(document.querySelectorAll('.inputs.recherche-simple input'), function(a, i){
        a.addEventListener('keydown', chargerGroupes);
    });
});

function chargerGroupes() {
	var liste_groupe = document.getElementById('liste-groupes'),
		charge = document.querySelector('.charge-groupe');
	charge.style.display = '';
	liste_groupe.style.display = 'none';
	clearTimeout(timeout);
    timeout = setTimeout(function(){
		if(!chargement) {
			chargement = true;
			var nom = document.querySelector('.inputs input[name=recherche]').value,
				sport = document.querySelector('.inputs select[name=sport]').value,
				recurrence = document.querySelector('.inputs select[name=recurrence]').value
				requete = new XMLHttpRequest();
			requete.open('GET', '?page=groupes&nom=' + nom + '&sport=' + sport + '&recurrence=' + recurrence, true);
			requete.onload = function() {
			    chargement = false;
			    if (requete.status >= 200 && requete.status < 400) {
	                var data = JSON.parse(requete.responseText);
					charge.style.display = 'none';
					liste_groupe.innerHTML = '';
					liste_groupe.style.display = '';
					if(data.length != 0) {
				        for (var i = data.length - 1; i >= 0; i--) {
				        	liste_groupe.innerHTML += '\
				        	<div class="groupe encadrer">\
								<a href="?page=groupe&amp;id=' + data[i].id_groupe + '">\
									<div class="details">\
										<div class="photo" style="background-image: url(\'static/user/groupes/'+data[i].id_groupe+'.jpg\');"></div>\
										<h4>'+data[i].titre+'</h4>\
										<p>\
											<i class="fa fa-fire"></i> '+data[i].nom+'<br>\
											<i class="fa fa-calendar"></i> '+data[i].recurrence.charAt(0).toUpperCase()+data[i].recurrence.slice(1)+'<br>\
											<i class="fa fa-users"></i> '+data[i].nbre+' participant'+(data[i].nbre > 1 ? 's' : '')+(data[i].max_participants > 0 ? ' sur ' +data[i].max_participants : '')+'<br>\
										</p>\
									</div>\
								</a>\
							</div>';
				        }
					}else {
						liste_groupe.innerHTML = '<div class="groupe encadrer align-center" style="width:100%;padding-top:10px;"><h4>Aucun résultat</h4></div>';
					}
			    } else {

			    }
			};
			requete.onerror = function(erreur) {
			    console.log(erreur);
			};
			requete.send();
		}
	}, 1000);
}