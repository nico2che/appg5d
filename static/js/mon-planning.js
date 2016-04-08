$(document).ready(function(){
	var mois = 0;
	$('.mois-precedent, .mois-suivant, .mois-zero').on('click', function(e){
		e.preventDefault();
		if($(this).hasClass('mois-precedent')) {
			mois--;
		} else if($(this).hasClass('mois-suivant')) {
			mois++;
		} else {
			mois = 0;
		}
		$.get('?page=mon-planning&mois=' + mois, function(json){
			$('.planning .detail').html(json.html);
			$('.titre-mois').html(json.mois)
		}, 'JSON');
	});
});