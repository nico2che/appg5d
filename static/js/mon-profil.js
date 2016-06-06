ready(function(){
	document.querySelector('.modifier-photo').addEventListener('click', function(e){
		e.preventDefault();
		var event = new CustomEvent("click");
		document.getElementById('avatar_fichier').dispatchEvent(event);
		document.getElementById('avatar_fichier').addEventListener('change', function(e){

		});
	});
});


$(document).ready(function(){
	$('#avatar_fichier').on('change', function(){
		var ancien = $('.photo').attr('src');
		var thumb = window.URL.createObjectURL(this.files[0]);
		$('.photo').css('background-image', 'url(static/images/ajax-loader.gif)').addClass('chargement-avatar');
		$('.avatar-menu').attr('src', 'static/images/ajax-loader.gif').addClass('chargement-avatar');
		$.ajax({
			url : '?page=mon-profil&upload',
			type : 'POST',
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
			data : ((window.FormData) ? new FormData($('#form_avatar')[0]) : $('#form_avatar').serialize()),
			success : function(data) {
				$('.photo').removeClass('chargement-avatar').css('background-image', 'url('+thumb+')');
				$('.avatar-menu').removeClass('chargement-avatar').attr('src', thumb);
			},
			error : function(){
				$('.photo').removeClass('chargement-avatar').css('background-image', 'url('+ancien+')');
				$('.avatar-menu').removeClass('chargement-avatar').attr('src', ancien);
			}
		})
	});
});