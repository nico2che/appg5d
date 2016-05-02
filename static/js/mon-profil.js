$(document).ready(function(){
	$('.modifier-photo').on('click', function(e){
		e.preventDefault();
		$('#avatar_fichier').trigger('click');
	});
	$('#avatar_fichier').on('change', function(){
		var ancien = $('.photo').attr('src');
		var thumb = window.URL.createObjectURL(this.files[0]);
		$('.photo').attr('src', 'static/images/ajax-loader.gif').addClass('chargement-avatar');
		$.ajax({
			url : '?page=mon-profil&upload',
			type : 'POST',
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
			data : ((window.FormData) ? new FormData($('#form_avatar')[0]) : $('#form_avatar').serialize()),
			success : function(data) {
				$('.photo').removeClass('chargement-avatar').attr('src', thumb);
			},
			error : function(){
				$('.photo').removeClass('chargement-avatar').attr('src', ancien);
			}
		})
	});
});