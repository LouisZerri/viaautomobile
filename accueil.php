<?php 

	require "include/header.php";
	require "include/functions.php";
	require "bdd/database.php";

	logged_only();
	
	$nom = $_SESSION['auth']->nom;
	$prenom = $_SESSION['auth']->prenom;

	$image = recupereImageAccueil();


?>
<style>
	
	html, body 
	{ 
	  margin:0;
	  padding:0;
	  font-family: 'Montserrat';
	  background: url('style/<?= $image->image_accueil; ?>') no-repeat center fixed; 
	  -webkit-background-size: cover; /* pour anciens Chrome et Safari */
	  background-size: cover; /* version standardisée */
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

	/* 
	##Device = Tablets, Ipads (portrait)
	##Screen = B/w 768px to 1024px
	*/

	@media (min-width: 768px) and (max-width: 1024px) 
	{
		
		.card {
    		position: absolute; 
			width: 50%; 
			height: 30%;
			bottom: 0; 
			left: 0;
			top: 0;
			right: 0;
			margin: auto;
			border-radius: 20px;
  		}
	}

	/* 
	##Device = Tablets, Ipads (landscape)
	##Screen = B/w 768px to 1024px
	*/

	@media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) 
	{
		.card {
    		position: absolute; 
			width: 50%; 
			height: 45%;
			bottom:0; 
			left:0;
			top: 0;
			right: 0;
			margin: auto;
			border-radius: 20px;
  		}
	}

	/* Ipad Pro */
	@media only screen and (min-device-width: 1024px) and (max-device-height: 1366px) and (-webkit-min-device-pixel-ratio: 2)  and (orientation: portrait)
	{
		.card {
    		position: absolute; 
			width: 45%; 
			height: 25%;
			bottom:0; 
			left:0;
			top: 0;
			right: 0;
			margin: auto;
			border-radius: 20px;
  		}
	}

	@media only screen and (min-device-width: 1366px) and (max-device-height: 1024px) and (-webkit-min-device-pixel-ratio: 2)  and (orientation: landscape)
	{
		.card {
    		position: absolute; 
			width: 45%; 
			height: 35%;
			bottom:0; 
			left:0;
			top: 0;
			right: 0;
			margin: auto;
			border-radius: 20px;
  		}
	}

</style>
<img style="float: right; padding-bottom: 170px; opacity: 0.5;" src="style/logo_blanc.svg" alt="logo" width="250" height="250">

<div class="card">
	<div class="card-body">
		<img src="style/logo_final.png" alt="logo" width="200"></br></br>
    	<span style="color: #531B51;" class="card-text"><b>Bonjour <?= $prenom; ?> <?= $nom ?> !</b></span></br>
    	<span style="color: #531B51;" >Que souhaitez-vous faire ?</span>
  	</div>
  	<div style="padding-left: 20px;" class="row">
	    <div class="col">
	      <a style="text-decoration: none; border: 1px solid #531B51; border-radius: 12px;" class="btn btn-light" href="tableau_de_bord.php" role="button"><span style="color: #531B51;">Tableau de bord</span></a>
	    </div>
	    <div style="padding-left: 40px;" class="col">
	      <a style="text-decoration: none; border: 1px solid #531B51; border-radius: 12px;" class="btn btn-light" href="https://viaautomobile.pepperbay.fr/tableau_de_bord.php#?w=500" role="button"><span style="color: #531B51;">Mandats</span></a>
	    </div>
	    <div style="padding-left: 20px;" class="col">
	      <a style="text-decoration: none; border: 1px solid #531B51; border-radius: 12px;" class="btn btn-light" href="https://viaautomobile.pepperbay.fr/tableau_de_bord.php#?w=750" role="button"><span style="color: #531B51;">Ventes</span></a>
	    </div>
		</br>
  	</div>
  	</br></br>
</div>








<?php require "include/footer.php" ?>