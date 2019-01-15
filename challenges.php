<?php 

	require "include/header.php";
	require "bdd/database.php";
	require "include/functions.php";

	logged_only();

	$nom = $_SESSION['auth']->nom;
	$prenom = $_SESSION['auth']->prenom;

?>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<style>

body
{
	font-family: 'Montserrat';
	text-decoration: none;
	list-style-type: none;
	color: #531B51;
}
.menu
{
	width: 300px;
	height: 400px;
	float: left;
}

.separation
{
	
	position: absolute;
	margin-left: 270px;
	height: 100%;
	width: 1px;
	background: grey;
	top: 0;
	bottom: 0;
	opacity: 0.2;
}

li
{
	list-style-type: none;
	position:relative;
	z-index:10;
}

span
{
	color: white;
}

#change
{
	color: #531B51;
	text-decoration: none;
	list-style-type: none;
}

#change:hover
{
	color: white;
	transition:all 0.10s;
	border:none;
	padding: 10px 10px 10px 10px;
	border-radius: 20px;
	background: #754974;
}

#screen
{
	bottom:0; 
	left:0;
	top: 0;
	right:0;  
	margin: auto;
}

@media screen and (min-width: 1080px) and (max-width: 1360px) {

	body
	{
		font-family: 'Montserrat';
		text-decoration: none;
		list-style-type: none;
		color: #531B51;
	}

	.menu
	{
		width: 500px;
		height: 400px;
		float: left;

	}

	#screen
	{
		position: absolute; 
		bottom:0; 
		left:0;
		top: 0;
		right:0;  
		margin: auto;
		margin-left: 100px;
		padding-top: 20px;
		zoom: 125%;
	}

	.separation
	{
		
		position: absolute;
		margin-left: 300px;
		height: 100%;
		width: 1px;
		background: grey;
		top: 0;
		bottom: 0;
		opacity: 0.2;
	}

}


@media screen and (min-height: 770px) and (max-height: 1920px) {

	body
	{
		font-family: 'Montserrat';
		text-decoration: none;
		list-style-type: none;
		color: #531B51;
	}

	.menu
	{
		width: 500px;
		height: 400px;
		float: left;
	}

	#screen
	{
		position: absolute; 
		bottom:0; 
		left:0;
		top: 0;
		right:0;  
		margin: auto;
		margin-left: 100px;
		padding-top: 20px;
		zoom: 125%;

	}

	.separation
	{
		
		position: absolute;
		margin-left: 300px;
		height: 100%;
		width: 1px;
		background: grey;
		top: 0;
		bottom: 0;
		opacity: 0.2;
	}

}


</style>
<div class="separation"></div>
<div class="menu">
	</br>
	</br>
	<img style="padding-left: 35px;" src="style/new_logo.svg" alt="logo" width="200"></br></br></br>
	<p style="padding-left: 45px;">Bonjour <b><?= $prenom; ?> <?= $nom; ?></b></p>
	</br>
	<ul>
		<li><a id="change" href="challenges.php"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;Les challenges</a></li></br>
		<li><a id="change" href="tableau_de_bord.php"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Mon tableau de bord</a></li></br>
		<li><a id="change" href="historique.php"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;Historique</a></li></br>
		<li><a id="change" href="#"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;Paramètres du compte</a></li></br>
		<li><a id="change" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Deconnexion</a></li></br>
	</ul>
	<img style="position: absolute; left: 0; bottom: 0; padding-left: 15px;" src="style/logo_gris.svg" alt="logo" width="230">
</div>
<div id="screen" class="container mt-2" style="padding-left: 200px;">
	<h3><b>LES CHALLENGES EN COURS</b></h3>
	<div class="row mt-3">
		<div class="col">
			<img style="border-radius: 10px;" src="style/challenge_ski.jpg" width="225" height="150">
		</div>
		<div class="col mt-3">
			<h5><b>1 WEEK-END A AVORIAZ A GAGNER</b></h5>
			<span style="color: #808080; font-size: 12px;">Période : Mois de décembre</span></br>
			<span style="color: black; font-size: 15px;">Le vainqueur sera le commercial vendant le plus de voiture au mois de décembre (calcul basé sur le nombre de commande)</span>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col">
			<img style="border-radius: 10px;" src="style/cinema.jpg" width="225" height="150">
		</div>
		<div class="col mt-3">
			<h5><b>2 PLACES DE CINEMA</b></h5>
			<span style="color: #808080; font-size: 12px;">Période : Du 12 au 17 novembre</span></br>
			<span style="color: black; font-size: 15px;">Le vainqueur sera le commercial rentrant le plus de mandat durant la semaine du 12 au 17 novembre</span>
		</div>
	</div>
	</br></br>
	<h3><b>CHALLENGES PASSÉS</b></h3>
	<div class="row mt-3">
		<div class="col">
			<img style="border-radius: 10px;" src="style/cinema.jpg" width="225" height="150">
		</div>
		<div class="col mt-3">
			<h5><b>2 PLACES DE CINEMA</b></h5>
			<span style="color: #808080; font-size: 12px;">Période : Du 12 au 17 novembre</span></br>
			<span style="color: black; font-size: 15px;">Le vainqueur sera le commercial rentrant le plus de mandat durant la semaine du 12 au 17 novembre</span>
			<span style="color: black; font-size: 15px;">Vainqueur : Michel Durand, Agence Tourcoing avec 58 mandats</span>

		</div>
	</div>
	
</div>

<?php require "include/footer.php"; ?>