var Categorie =[document.getElementById("complete"),document.getElementById("rejoindre"),document.getElementById("creer"),document.getElementById("forum"),document.getElementById("planning")];
var tailleCadre=document.getElementById("cadre");

var affichage= function(menu){
	for (var i=1;i<Categorie.length+1;i++){
	if(i==menu){
		Categorie[i-1].style.display= "block";
	}
	else {
		Categorie[i-1].style.display= "none";
	}
	tailleCadre.style.borderWidth="2px";
}

}







