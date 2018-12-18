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
	clear: both;
	position: absolute;
	margin-left: 270px;
	height: 570px;
	width: 1px;
	background: grey;
}

.separation2
{
	clear: both;
	position: absolute;
	margin-left: 5px;
	height: 450px;
	width: 3px;
	margin-top: 50px;
	background:  #531B51;
}

li
{
	list-style-type: none;
}

span
{
	color: white;
}

#change
{
	color: #531B51;
}

#change:hover
{
	color: white;
	text-decoration: none;
	list-style-type: none;
	transition:all 1s;
}

li:hover
{
	background-color: #531B51;
	border:1px solid #531B51;
	-moz-border-radius: 10px 0;
	-webkit-border-radius: 10px 0;
	border-radius: 10px 0;
	width: 80%;
	color: white;
	text-decoration: none;
	list-style-type: none;
	transition:all 1s;
}
</style>
<div class="container">
	<?php if(!empty($errors)): ?>
		<div class="alert alert-danger">
			<p>Vous n'avez pas rempli le formulaire correctement : </p>
			<ul>
				<?php foreach ($errors as $error): ?>
					<li><?= $error; ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
</div>
<div>
	<hr class="separation" style="position: fixed;"/>
</div>
<div class="menu" style="position: fixed;">
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
	<img style="padding-left: 35px; height: 160px;" src="style/logo_gris.svg" alt="logo" width="200">
</div>
<div class="container mt-2" style="padding-left: 200px;">
	<h3><b>LES CHALLENGES EN COURS</b></h3>
	<div class="row mt-3">
		<div class="col">
			<img style="border-radius: 10px;" src="style/challenge_ski.jpg" width="225" height="150">
		</div>
		<div class="col mt-3" style="width: 100px;">
			<h5><b>1 WEEK-END A AVORIAZ A GAGNER</b></h5>
			<span style="color: #808080; font-size: 12px;">Période : Mois de décembre</span></br>
			<span style="color: black; font-size: 15px;">Le vainqueur sera le commercial vendant le plus de voiture au mois de décembre (calcul basé sur le nombre de commande)</span>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col">
			<img style="border-radius: 10px;" src="style/cinema.jpg" width="225" height="150">
		</div>
		<div class="col mt-3" style="width: 100px;">
			<h5><b>2 PLACES DE CINEMA</b></h5>
			<span style="color: #808080; font-size: 12px;">Période : Du 12 au 17 novembre</span></br>
			<span style="color: black; font-size: 15px;">Le vainqueur sera le commercial rentrant le plus de mandat durant la semaine du 12 au 17 novembre</span>
		</div>
	</div>
	</br>
	<h3><b>CHALLENGES PASSÉS</b></h3>
	<div class="row mt-3">
		<div class="col">
			<img style="border-radius: 10px;" src="style/cinema.jpg" width="225" height="150">
		</div>
		<div class="col mt-3" style="width: 100px;">
			<h5><b>2 PLACES DE CINEMA</b></h5>
			<span style="color: #808080; font-size: 12px;">Période : Du 12 au 17 novembre</span></br>
			<span style="color: black; font-size: 15px;">Le vainqueur sera le commercial rentrant le plus de mandat durant la semaine du 12 au 17 novembre</span>
			<span style="color: black; font-size: 15px;">Vainqueur : Michel Durand, Agence Tourcoing avec 58 mandats</span>

		</div>
	</div>
	
	
	
	
</div>