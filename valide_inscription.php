<?php require "include/header.php"; ?>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<style>
	html, body { 
	  margin:0;
	  padding:0;
	  font-family: 'Montserrat';
	  background: url(style/fond.svg) no-repeat center fixed; 
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

	#fin 
	{
  		position : absolute;
  		bottom : 0px;
  		padding-left: 1200px;
  		font-size: 12px;
	}

	.card
	{
		position: absolute; 
		width: 40%; 
		height: 45%; 
		top:0; 
		bottom:0; 
		left:0; 
		right: 0; 
		margin: auto;
	}

</style>
<img style="float: right; padding-bottom: 150px;" src="style/logo_blanc" alt="logo" width="250" height="250">

<div class="card">
	<center>
		</br>
		<img src="style/logo_couleur.svg" alt="logo" width="300" height="75">
	</center>
	<div class="card-body">
		</br>
		<center>
    		<b>Merci pour votre inscription</b></br></br>
    		<p>Un email de confirmation a été envoyé</br>à votre adresse email</p>
    	</center>
  	</div>
</div>





<div id="fin">
	<p style="color: white;">Powered by Pepperbay</p>
</div>


<?php require "include/footer.php"; ?>