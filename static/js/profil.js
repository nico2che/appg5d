ready(function(){
	var boutons_accepter = document.querySelectorAll('.reponse.accepter'), boutons_refuser = document.querySelectorAll('.reponse.refuser'), chargement = false;
	if(boutons_accepter != undefined) {
		for (var i = boutons_accepter.length - 1; i >= 0; i--) {
			boutons_accepter[i].addEventListener('click', function(e){
				var that = this;
				if(!chargement) {
					chargement = true;
					e.preventDefault();
					var requete = new XMLHttpRequest();
					requete.open('GET', '?page=profil&accepter=' + this.dataset.id, true);
					requete.onload = function() {
					    if (requete.status >= 200 && requete.status < 400) {
			                var data = JSON.parse(requete.responseText);
							if(data.length != 0 && data.statut == 0) {
								that.parentNode.classList.add('repondu');
								that.parentNode.innerHTML = data.message;
							}
					    }
					};
					requete.send();
				}
			});
			boutons_refuser[i].addEventListener('click', function(e){
				var that = this;
				if(!chargement) {
					chargement = true;
					e.preventDefault();
					var requete = new XMLHttpRequest();
					requete.open('GET', '?page=profil&refuser=' + this.dataset.id, true);
					requete.onload = function() {
					    if (requete.status >= 200 && requete.status < 400) {
			                var data = JSON.parse(requete.responseText);
							if(data.length != 0 && data.statut == 0) {
								that.parentNode.classList.add('repondu');
								that.parentNode.innerHTML = data.message;
							}
					    }
					};
					requete.send();
				}
			});
		}
	}
});