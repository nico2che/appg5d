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

    var liens = document.querySelectorAll('a.lieu');
    for (var i = liens.length - 1; i >= 0; i--) {
        liens[i].addEventListener('click', function(e){
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
    }

    var chargement = false, reponse_invitation = document.querySelector('.reponse-invitation');
    if(reponse_invitation != undefined) {
        document.getElementById('invitation-envoie').addEventListener('click', function(){
            var email_pseudo = document.getElementById('invitation').value;
            if(email_pseudo != "" && !chargement) {
                chargement = true;
                var that = this;
                this.innerHTML = 'Chargement';
                this.disabled = true;
                var requete = new XMLHttpRequest();
                requete.open('GET', '?page=groupe&invitation=' + email_pseudo + '&id=' + this.dataset.id, true);
                requete.onload = function() {
                    if (requete.status >= 200 && requete.status < 400) {
                        var data = JSON.parse(requete.responseText);
                        reponse_invitation.classList.remove('rouge');
                        reponse_invitation.classList.remove('green');
                        if(data.statut > 0) {
                            reponse_invitation.classList.add('rouge');
                        } else {
                            reponse_invitation.classList.add('vert');
                        }
                        reponse_invitation.innerHTML = data.message;
                    } else {
                        reponse_invitation.innerHTML = 'Erreur, réessayez plus tard';
                        reponse_invitation.classList.add('rouge');
                    }
                    chargement = false;
                    that.innerHTML = 'Inviter';
                    that.removeAttribute('disabled');
                };
                requete.onerror = function(erreur) {
                    console.log(erreur);
                };
                requete.send();
            }
        });
    }

    var liens = document.querySelectorAll('a.participation');
    for (var i = liens.length - 1; i >= 0; i--) {
        liens[i].addEventListener('click', function(e){
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
    }
    var liens = document.querySelectorAll('a.supprimer-date');
    for (var i = liens.length - 1; i >= 0; i--) {
        liens[i].addEventListener('click', function(e){
            e.preventDefault();
            if(confirm('Etes vous sûr de vouloir supprimer cette date ?')) {
                if(!chargement) {
                    chargement = true;
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
    }

    var modifie = false;
    if(document.querySelector('.modifier-membres') != undefined) {
        document.querySelector('.modifier-membres').addEventListener('click', function(e){
            e.preventDefault();
            if(!modifie) {
                var checkboxes = document.querySelectorAll('.check-membre');
                for (var i = checkboxes.length - 1; i >= 0; i--) {
                    checkboxes[i].style.display = '';
                }
                var liens = document.querySelectorAll('.profil.membres');
                for (var i = liens.length - 1; i >= 0; i--) {
                    liens[i].onclick = function() {
                        if(this.querySelector('input').checked)
                            this.querySelector('input').checked = false;
                        else
                            this.querySelector('input').checked = true;
                        return false;
                    };
                }
                document.querySelector('.actions-membres').style.display = '';
                this.innerHTML = 'Annuler';
                modifie = true;
            } else {
                var checkboxes = document.querySelectorAll('.check-membre');
                for (var i = checkboxes.length - 1; i >= 0; i--) {
                    checkboxes[i].style.display = 'none';
                }
                var liens = document.querySelectorAll('.profil.membres');
                for (var i = liens.length - 1; i >= 0; i--) {
                    liens[i].onclick = function() {
                        return true;
                    };
                }
                document.querySelector('.actions-membres').style.display = 'none';
                this.innerHTML = 'Modifier';
                modifie = false;
            }
        });
    }

    var modifie_responsables = false;
    if(document.querySelector('.modifier-responsables') != undefined) {
        document.querySelector('.modifier-responsables').addEventListener('click', function(e){
            e.preventDefault();
            if(!modifie_responsables) {
                var checkboxes = document.querySelectorAll('.check-responsables');
                for (var i = checkboxes.length - 1; i >= 0; i--) {
                    checkboxes[i].style.display = '';
                }
                var liens = document.querySelectorAll('.profil.responsables');
                for (var i = liens.length - 1; i >= 0; i--) {
                    liens[i].onclick = function() {
                        if(this.querySelector('input').checked)
                            this.querySelector('input').checked = false;
                        else
                            this.querySelector('input').checked = true;
                        return false;
                    };
                }
                document.querySelector('.actions-responsables').style.display = '';
                this.innerHTML = 'Annuler';
                modifie_responsables = true;
            } else {
                var checkboxes = document.querySelectorAll('.check-responsables');
                for (var i = checkboxes.length - 1; i >= 0; i--) {
                    checkboxes[i].style.display = 'none';
                }
                var liens = document.querySelectorAll('.profil.responsables');
                for (var i = liens.length - 1; i >= 0; i--) {
                    liens[i].onclick = function() {
                        return true;
                    };
                }
                document.querySelector('.actions-responsables').style.display = 'none';
                this.innerHTML = 'Modifier';
                modifie_responsables = false;
            }
        });
    }
})