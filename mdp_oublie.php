<?php 

	session_start();

	require 'include/header.php';
	require 'include/functions.php';

	if(!empty($_POST))
	{
		$errors = array();

		require_once 'bdd/database.php';

		if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			$errors['email'] = "Votre email n'est pas valide";
		}

		if(empty($errors))
		{
			 $_SESSION['flash']['success'] = "Un email a été envoyé pour réinitialiser votre mot de passe";
			header('Location: login.php');
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
  		position : absolute;
  		bottom : 0px;
  		padding-left: 1200px;
  		font-size: 12px;
	}

	.card
	{
		width: 40%;
		margin-left: 400px;
		margin-top: 125px;
	}

	.form-control
	{
		font-size: 12px;
	}

</style>
<img style="float: right; padding-bottom: 150px;" src="style/logo_blanc" alt="logo" width="250" height="250">
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

<div class="card">
	<center>
		</br>
		<img src="style/logo_couleur.png" alt="logo" width="200" height="50">
	</center>
	<div class="card-body">
		</br>
		<center>
    		<b>Vous avez oublié votre de mot de passe ?</b></br></br>
    		<form action="" method="POST">
				<div class="form-group">
					<input type="text" name="email" class="form-control" placeholder="Saissisez votre adresse email" required>
				</div>
				<button style="background-color: #9D1458;" type="submit" class="btn btn-light"><span style="color: white;">M'envoyer un nouveau mot de passe</span></button>
			</form>
    	</center>
  	</div>
</div>





<div id="fin">
	<p style="color: white;">Powered by Pepperbay</p>
</div>


<?php require "include/footer.php"; ?>