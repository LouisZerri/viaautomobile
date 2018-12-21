<?php

	require 'include/header.php';

	session_start();
	
	if(!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password']))
	{
	    require_once 'bdd/database.php';

		$user = vendeurExiste($_POST['email']);

	    if($user == null)
	    {
	        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';
	    }
	    elseif(password_verify($_POST['password'], $user->mot_de_passe))
	    {
	        $_SESSION['auth'] = $user;
	        $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
	        header('Location: accueil.php');
	    }
	    else
	    {	
	        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';
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

	p
	{
		color: white;
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
<img style="float: right; padding-bottom: 150px;" src="style/logo_blanc.svg" alt="logo" width="250" height="250">
<div class="container" style="padding-top: 90px;">
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
	<div class="card" style="width: 50%; height: 50%; margin-left: 280px;">
	<center>
		</br>
		<img src="style/logo_couleur.svg" alt="logo" width="300" height="75">
		</br>
	</center>	
	  	<div class="card-body">
			<form action="" method="POST">
				<div class="form-group">
					<input type="text" name="email" class="form-control" placeholder="Saissisez votre adresse email" required>
				</div>
				<div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="Saissisez votre mot de passe" required>
				</div>
				<center><a href="mdp_oublie.php">Mot de passe oublié ?</a></center></br>
				<center>
					<button style="background-color: #9D1458;" type="submit" class="btn btn-outline-light"><span style="color: white;">connexion</span></button>
				</center>
			</form>
	  	</div>
	</div>
</div>
























<div id="fin">
	<p>Powered by Pepperbay</p>
</div>

<?php require "include/footer.php"; ?>