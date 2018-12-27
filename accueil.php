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

	.card {
		position: absolute; 
		width: 40%; 
		height: 50%;
		bottom:0; 
		left:0; 
		margin: auto;
		margin-left: 40px;
		margin-bottom: 40px;
		border-radius: 20px;


	}

	@media screen and (min-width: 1080px) and (max-width: 1360px) {
  		.card {
    		position: absolute; 
			width: 27%; 
			height: 30%;
			bottom:0; 
			left:0;  
			margin: auto;
			margin-left: 50px;
			margin-bottom: 50px;
			border-radius: 20px;
  		}
	}

	@media screen and (min-height: 770px) and (max-height: 1920px) {
  		.card {
    		position: absolute; 
			width: 27%; 
			height: 30%;
			bottom:0; 
			left:0;  
			margin: auto;
			margin-left: 50px;
			margin-bottom: 50px;
			border-radius: 20px;
  		}
	}

</style>
<img style="float: right; padding-bottom: 170px; opacity: 0.5;" src="style/logo_blanc.svg" alt="logo" width="250" height="250">

<div class="card">
	<div class="card-body">
		<img src="style/new_logo.svg" alt="logo" width="200"></br></br></br>
    	<span class="card-text"><b>Bonjour <?= $prenom; ?> <?= $nom ?> !</b></span></br>
    	<span>Que souhaitez-vous faire ?</span>
  	</div>
  	<div style="padding-left: 20px;" class="row">
	    <div class="col">
	      <a style="text-decoration: none; border: 1px solid #531B51; border-radius: 12px;" class="btn btn-light" href="tableau_de_bord.php" role="button"><span>Tableau de bord</span></a>
	    </div>
	    <div style="padding-left: 40px;" class="col">
	      <a style="text-decoration: none; border: 1px solid #531B51; border-radius: 12px;" class="btn btn-light" href="mandats.php" role="button"><span>Mandats</span></a>
	    </div>
	    <div style="padding-left: 20px;" class="col">
	      <a style="text-decoration: none; border: 1px solid #531B51; border-radius: 12px;" class="btn btn-light" href="ventes.php" role="button"><span>Ventes</span></a>
	    </div>
		</br>
  	</div>
  	</br></br>
</div>








<?php require "include/footer.php" ?>