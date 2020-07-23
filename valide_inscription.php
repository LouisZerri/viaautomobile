<?php require "include/header.php"; ?>
<style>

	@media screen and (min-width: 1080px) and (max-width: 1360px) {
  		
  		.card {
    		position: absolute; 
			width: 25%; 
			height: 30%; 
			top:0; 
			bottom:0; 
			left:0; 
			right: 0; 
			margin: auto;
			border-radius: 15px;
  		}
	}

	@media screen and (min-height: 770px) and (max-height: 1920px) {

		.card {
    		position: absolute; 
			width: 25%; 
			height: 30%; 
			top:0; 
			bottom:0; 
			left:0; 
			right: 0; 
			margin: auto;
			border-radius: 15px;
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
			width: 40%; 
			height: 25%; 
			top:0; 
			bottom:0; 
			left:0; 
			right: 0; 
			margin: auto;
			border-radius: 15px;
  		}
	}

	/* 
	##Device = Tablets, Ipads (landscape)
	##Screen = B/w 768px to 1024px
	*/

	@media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) 
	{
		.card
		{
			position: absolute; 
			width: 35%; 
			height: 45%; 
			top: 0; 
			bottom: 0; 
			left: 0; 
			right: 0;
			margin: auto;
			border-radius: 15px;
		}
	}

</style>
<img style="right: 0; padding-bottom: 170px; position: fixed;" src="style/logo_blanc.svg" alt="logo" width="250" height="250">

<div class="card">
	<center>
		</br>
		<img src="style/logo_couleur.svg" alt="logo" width="300" height="75">
	</center>
	<div class="card-body">
		</br>
		<center>
    		<b>Merci pour votre inscription</b></br></br>
    		<p style="color: black;">Un email de confirmation a été envoyé</br>à votre adresse email</p>
    	</center>
  	</div>
</div>





<div id="fin">
	<p style="color: white;">Powered by Pepperbay</p>
</div>


<?php require "include/footer.php"; ?>