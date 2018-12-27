<?php 

	require 'include/header.php';
	require 'include/functions.php';

	if(!empty($_POST) && !empty($_POST['email']))
	{
		require_once "bdd/database.php";

		$vendeur = vendeurExiste($_POST['email']);

		if($vendeur)
		{
			session_start();
			$reset_token = str_random(60);
			resetToken($reset_token, $vendeur->id_vendeur);
			$_SESSION['flash']['success'] = 'Les instructions du rappel de mot de passe vous ont été envoyées par email';
			sendEmailForReset($_POST['email'], $vendeur->id_vendeur, $reset_token);
			header('Location: login.php');
			exit();
		}
		else
		{
			$_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cet adresse';
		}
	}
?>

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
		position: fixed;
  		right: 0;
  		bottom: 0;
		font-size: 12px;
		padding-right: 20px;
		color: white;
	}

	.card
	{
		position: absolute; 
		width: 35%; 
		height: 50%; 
		top:0; 
		bottom:0; 
		left:0; 
		right: 0; 
		margin: auto;
		border-radius: 15px;
	}

	.form-control
	{
		font-size: 12px;
	}

	@media screen and (min-width: 1080px) and (max-width: 1360px) {
  		.card {
    		position: absolute; 
			width: 27%; 
			height: 35%; 
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
			width: 27%; 
			height: 35%; 
			top:0; 
			bottom:0; 
			left:0; 
			right: 0; 
			margin: auto;
			border-radius: 15px;
  		}
	}

</style>
<img style="right: 0; padding-bottom: 170px; position: fixed;" src="style/logo_blanc.svg" alt="logo" width="250" height="250">

<div class="container">
	<?php if(isset($_SESSION['flash'])): ?>
	  <?php foreach($_SESSION['flash'] as $type => $message): ?>
		<div class="alert alert-<?= $type;?> alert-dismissible fade show" role="alert">
		  <?= $message; ?>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    		<span aria-hidden="true">&times;</span>
  		</button>
		</div>
	  <?php endforeach; ?>
	  <?php unset($_SESSION['flash']); ?>
	<?php endif; ?>
</div>

<div class="card">
	<center>
		</br>
		<img src="style/logo_couleur.svg" alt="logo" width="300" height="75">
	</center>
	<div class="card-body">
		<center>
    		<b>Vous avez oublié votre de mot de passe ?</b></br></br>
    		<form action="" method="POST">
				<div class="form-group">
					<input type="text" name="email" class="form-control" placeholder="Saissisez votre adresse email" required>
				</div></br>
				<button style="background-color: #9D1458;" type="submit" class="btn btn-light"><span style="color: white;">M'envoyer un nouveau mot de passe</span></button>
			</form>
    	</center>
  	</div>
</div>





<div id="fin">
	<p style="color: white;">Powered by Pepperbay</p>
</div>


<?php require "include/footer.php"; ?>