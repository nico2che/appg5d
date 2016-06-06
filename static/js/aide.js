ready(function(){
	affichage(document.querySelectorAll('.rubrique')[0].id)
});

function affichage(id) {
	var blocks = document.querySelectorAll('.rubrique');
	for (var i=0;i<blocks.length;i++){
		blocks[i].style.display= "none";
	}
	document.getElementById(id).style.display = 'block';
}