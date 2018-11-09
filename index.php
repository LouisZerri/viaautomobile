<?php require "include/header.php"; ?>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<style>
	html, body { 
	  margin:0;
	  padding:0;
	  background: url(style/fond.svg) no-repeat center fixed; 
	  -webkit-background-size: cover; /* pour anciens Chrome et Safari */
	  background-size: cover; /* version standardisée */
	}

	#p1
	{
		color: white;
		font-size: 5em;
		font-family: 'Montserrat';
	}

	#p2
	{
		color: white;
		font-family: 'Montserrat';
		font-size: 5em;
	}

	p
	{
		color: white;
		font-family: 'Montserrat';
	}

	#fin 
	{
  		position : absolute;
  		bottom : 0px;
  		padding-left: 1200px;
  		font-size: 12px;
  		font-family: 'Montserrat';
	}
</style>
<img style="float: right; padding-bottom: 150px;" src="style/logo_blanc" alt="logo" width="250" height="250">
<div style="padding-top: 200px; padding-left: 20px;">
	<span id="p1">CHALLENGEZ</span></br>
	<b id="p2">VOS COLLABORATEURS</b>
</div>

<a style="margin-left: 20px;" class="btn btn-outline-light" href="login.php" role="button">connexion</a>
<button style="margin-left: 20px;" type="button" class="btn btn-outline-light">inscription</button>


<div id="fin">
	<p>Powered by Pepperbay</p>
</div>


<?php require "include/footer.php"; ?>