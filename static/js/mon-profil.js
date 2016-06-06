ready(function(){
	document.querySelector('.modifier-photo').addEventListener('click', function(e){

		e.preventDefault();

		var event = new CustomEvent("click");
		document.getElementById('avatar_fichier').dispatchEvent(event);

		document.getElementById('avatar_fichier').addEventListener('change', function(e){

			var ancien = document.querySelector('.photo').getAttribute('src'),
				thumb = window.URL.createObjectURL(this.files[0]),
				photo = document.querySelector('.photo'),
				avatar = document.querySelector('.avatar-menu');

			photo.style.backgroundImage = "url(static/images/ajax-loader.gif)";
			photo.classList.add('chargement-avatar');
			avatar.setAttribute('src', "static/images/ajax-loader.gif");
			avatar.classList.add('chargement-avatar');

			var requete = new XMLHttpRequest();
			requete.open('POST', '?page=mon-profil&upload', true);
			requete.onload = function() {
			    if (requete.status >= 200 && requete.status < 400) {
	                var data = JSON.parse(requete.responseText);
					if(data.length != 0 && data.statut == 0) {
						photo.classList.remove('chargement-avatar');
						photo.style.backgroundImage = 'url('+thumb+')';
						avatar.classList.remove('chargement-avatar');
						avatar.style.backgroundImage = 'url('+thumb+')';
					} else {
						photo.classList.remove('chargement-avatar');
						photo.style.backgroundImage = 'url('+ancien+')';
						avatar.classList.remove('chargement-avatar');
						avatar.style.backgroundImage = 'url('+ancien+')';
					}
			    } else {

			    }
			};
			requete.onerror = function(erreur) {
				photo.classList.remove('chargement-avatar');
				photo.style.backgroundImage = 'url('+ancien+')';
				avatar.classList.remove('chargement-avatar');
				avatar.style.backgroundImage = 'url('+ancien+')';
			};
			requete.send(new FormData(document.getElementById('form_avatar')));
		});
	});
});