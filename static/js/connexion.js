var chargement = 1;

$(document).ready(function(){
  $('.connexion-fb').on('click', function(e){
    e.preventDefault();
    loginFb();
  });
});

function loginFb() {
  toggleChargement();
  FB.getLoginStatus(function(check) {
    if (check.status === 'connected') {
      FB.api('/me?fields=name,email', function(login) {
        toggleChargement('Se connecter en tant que ' + login.name);
      });
    } else {
        toggleChargement('Connexion via Facebook');
    }
  });
}

function toggleChargement(texte) {
  if(chargement == 0) {
    $('.connexion-fb .texte').html('Chargement...');
    chargement = 1;
  } else {
    $('.connexion-fb .texte').html(texte);
    chargement = 0;
  }
}

window.fbAsyncInit = function() {
  FB.init({
    appId      : '1313308782019341',
    cookie     : true,
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.6' // use version 2.2
  });
  FB.getLoginStatus(function(check) {
    if (check.status === 'connected') {
      FB.api('/me?fields=name,email', function(login) {
        toggleChargement('Se connecter en tant que ' + login.name);
      });
    } else {
        toggleChargement('Connexion via Facebook');
    }
  });
};

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));