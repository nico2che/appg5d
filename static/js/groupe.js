ready(function(){
    function creation() {
        var input = document.getElementById('localisationAutoCompletion');
        var options = {
            componentRestrictions: {country: 'fr'}
        };
        autocomplete = new google.maps.places.Autocomplete(input, options);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            console.log(place.geometry.location.lat(), place.geometry.location.lng())
            document.getElementById('localisation_la').value = place.geometry.location.lat();
            document.getElementById('localisation_lo').value = place.geometry.location.lng();
        });
    }
    google.maps.event.addDomListener(window, 'load', creation);
    Array.prototype.forEach.call(document.querySelectorAll('a.lieu'), function(a, i){
        a.addEventListener('click', function(e){
            e.preventDefault();
            Array.prototype.forEach.call(document.querySelectorAll('.coordonnees'), function(el, i){
                el.remove();
            });
            if(this.classList) {
                if(this.classList.contains('ouvert')) {
                    this.classList.remove('ouvert');
                    return;
                }
            }
            this.classList.add('ouvert');
            this.parentNode.parentNode.insertAdjacentHTML('afterend', '<div class="encadrer coordonnees">   </div>');
            var map = new GMaps({
              div: '.coordonnees',
              lat: this.dataset.coordonnees.split(',')[0],
              lng: this.dataset.coordonnees.split(',')[1]
            });
            map.addMarker({
              lat: this.dataset.coordonnees.split(',')[0],
              lng: this.dataset.coordonnees.split(',')[1]
            });
        });
    });
    var chargement = false;
    Array.prototype.forEach.call(document.querySelectorAll('a.participation'), function(a, i){
        a.addEventListener('click', function(e){
            if(!chargement) {
                chargement = true;
                e.preventDefault();
                var that = this;
                this.querySelector('.participer img').style.display = '';
                this.querySelector('.participer i').style.display = 'none';
                var requete = new XMLHttpRequest();
                requete.open('GET', '?page=groupe&date=' + this.dataset.id + '&id=' + this.dataset.idgroupe, true);
                requete.onload = function() {
                    chargement = false;
                    if (requete.status >= 200 && requete.status < 400) {
                        var data = JSON.parse(requete.responseText);
                        that.querySelector('.participer img').style.display = 'none';
                        that.querySelector('.participer i').style.display = '';
                        if(data.statut == 0 && data.type == 1) {
                            that.querySelector('.participer i').classList.remove('fa-calendar-check-o');
                            that.querySelector('.participer i').classList.add('fa-calendar-plus-o');
                            that.querySelector('.participer').classList.remove('vert');
                        } else if(data.statut == 0 && data.type == 2) {
                            that.querySelector('.participer i').classList.remove('fa-calendar-plus-o');
                            that.querySelector('.participer i').classList.add('fa-calendar-check-o');
                            that.querySelector('.participer').classList.add('vert');
                        } else {
                            console.error('Erreur : ' + data.statut);
                        }
                    } else {

                    }
                };
                requete.onerror = function(erreur) {
                    console.log(erreur);
                };
                requete.send();
            }
        });
    });
    Array.prototype.forEach.call(document.querySelectorAll('a.supprimer-date'), function(a, i){
        a.addEventListener('click', function(e){
            if(confirm('Etes vous sûr de vouloir supprimer cette date ?')) {
                if(!chargement) {
                    chargement = true;
                    e.preventDefault();
                    var that = this;
                    var requete = new XMLHttpRequest();
                    requete.open('GET', '?page=groupe&supprimer-date=' + this.dataset.id + '&id=' + this.dataset.idgroupe, true);
                    requete.onload = function() {
                        chargement = false;
                        if (requete.status >= 200 && requete.status < 400) {
                            var data = JSON.parse(requete.responseText);
                            if(data.statut == 0) {
                                that.parentNode.parentNode.remove();
                            }
                        } else {

                        }
                    };
                    requete.onerror = function(erreur) {
                        console.log(erreur);
                    };
                    requete.send();
                }   
            }
        });
    });
})