<!DOCTYPE html>
<style>
#cover {
  width: 100%;
  position : absolute;
  top:0;
  left:0;
  z-index: -1;
}

.image
{
  max-width: 100%;
}

.slogan {
  clear: both;
  color: white;
  font-size: 40px;
  font-weight: bold;
  margin: 30px auto auto;
  text-transform: uppercase;
  width: 562px;
  text-shadow: 0px 0px 4px black;
}
form.accueil {
  margin: 130px auto;
  width: 320px;
}
form.accueil select {
   width: 240px;
   height: 34px;
   overflow: hidden;
   background: url(new_arrow.png) no-repeat right #ddd;
   border: 1px solid #ccc;
}

.titre
{
  margin-top : 500px;
  text-align: center;
}

#titreAnnonces
{
  margin-top: 50px;
}

#annonces
{
  margin-top: 50px;
  background-color: blue; 
}

body div div div.annonces
{
  margin-left: 30%;
  display : inline-block;

}
</style>
<html>
<img src="images/logo.png" width="150" height="200" />
<body>
<center>
	<form method="post" action="traitement.php">
    <p>
        <label><font face="Verdana">Identifiant</font></label> : <input type="text" name="pseudo" />
    </p>
	<p>
		<label><font face="Verdana">Mot de passe</font></label> : <input type="text" name="mot de passe" />
	</p>
</form>
</center>
</body>
</html>