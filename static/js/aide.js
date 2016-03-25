var Categorie =[document.getElementById("complete"),document.getElementById("creer"),document.getElementById("rejoindre"),document.getElementById("forum"),document.getElementById("planning")];

var test = prompt("enter un nombre en 0 et 4");

for (var i=0;i<Categorie.length;i++){
	if(i==test){
		Categorie[i].style.display= "block";
	}
	else {
		Categorie[i].style.display= "none";
	}
}

