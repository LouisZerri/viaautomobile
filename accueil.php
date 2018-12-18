<?php 

	require "include/header.php";
	require "include/functions.php";

	session_start();
	
	$nom = $_SESSION['auth']->nom;
	$prenom = $_SESSION['auth']->prenom;
?>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<style>
	body { 
	  margin:0;
	  padding:0;
	  font-family: 'Montserrat';
	  background: url(style/ski.png) no-repeat center fixed; 
	  -webkit-background-size: cover; /* pour anciens Chrome et Safari */
	  background-size: cover; /* version standardisée */
	}

	#p1
	{
		color: white;
		font-size: 5em;
	}

	#p2
	{
		color: white;
		font-size: 5em;
	}

	span
	{
		color: #531B51;
	}

	#fin 
	{
  		position : absolute;
  		bottom : 0px;
  		padding-left: 1200px;
  		font-size: 12px;
	}

	a
	{
		color: black;
		text-decoration: underline;
	}

	a:hover
	{
		color: black;
	}

	.form-control
	{
		font-size: 10px;
	}

</style>
<img style="float: right; padding-bottom: 170px; opacity: 50%;" src="style/logo_blanc.svg" alt="logo" width="250" height="250">

<div style="margin-left: 20px; width: 40%; position: fixed; bottom: 20px;"class="card">
	<div class="card-body">
		<img src="style/new_logo.svg" alt="logo" width="200"></br></br>
    	<span class="card-text"><b>Bonjour <?= $prenom; ?> <?= $nom ?> !</b></span></br>
    	<span>Que souhaitez-vous faire ?</span>
  	</div>
  	<div style="padding-left: 20px;" class="row">
	    <div class="col-sm">
	      <a style="text-decoration: none; border: 2px solid #531B51; border-radius: 12px;" class="btn btn-outline-light" href="tableau_de_bord.php" role="button"><span>Tableau de bord</span></a>
	    </div>
	    <div style="padding-left: 60px;" class="col-sm">
	      <a style="text-decoration: none; border: 2px solid #531B51; border-radius: 12px;" class="btn btn-outline-light" href="mandats.php" role="button"><span>Mandats</span></a>
	    </div>
	    <div style="padding-left: 20px;" class="col-sm">
	      <a style="text-decoration: none; border: 2px solid #531B51; border-radius: 12px;" class="btn btn-light" href="ventes.php" role="button"><span>Ventes</span></a>
	    </div>
		</br>
  	</div>
  	</br></br>
</div>








<?php require "include/footer.php" ?>