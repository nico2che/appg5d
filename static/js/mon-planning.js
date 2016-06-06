ready(function(){
	var mois = 0, boutons = document.querySelectorAll('.mois-precedent, .mois-suivant, .mois-zero');
	for (var i = boutons.length - 1; i >= 0; i--) {
		boutons[i].addEventListener('click', function(e){
			e.preventDefault();
			if(this.classList.contains('mois-precedent')) {
				mois--;
			} else if(this.classList.contains('mois-suivant')) {
				mois++;
			} else {
				mois = 0;
			}
			var requete = new XMLHttpRequest();
			requete.open('GET', '?page=mon-planning&mois=' + mois, true);
			requete.onload = function() {
			    if (requete.status >= 200 && requete.status < 400) {
	                var data = JSON.parse(requete.responseText);
					if(data.length != 0) {
						document.querySelector('.planning .detail').innerHTML = data.html;
						document.querySelector('.titre-mois').innerHTML = data.mois;
					}
			    }
			};
			requete.send();
		});
	}
});