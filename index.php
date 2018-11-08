<?php
	
	session_start();

	require 'include/header.php';

	if(!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password']))
	{
	    require_once 'bdd/database.php';

		$user = connexionApplication($_POST['email']);

	    if($user == null)
	    {
	        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';
	    }
	    elseif($user->mot_de_passe == $_POST['password'])
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

	<div class="card" style="width: 50%; height: 50%; margin-left: 280px;">
		<div class="card-header">
			<center><h3>Connectez-vous</h3></center>
	  	</div>
	  	<div class="card-body">
			<form action="" method="POST">
				<div class="form-group">
					<label for=""><span class="fa fa-envelope"></span>&nbsp;&nbsp;Email : </label>
					<input type="text" name="email" class="form-control" required>
				</div>
				<div class="form-group">
					<label for=""><span class="fa fa-key"></span>&nbsp;&nbsp;Mot de passe : </label>
					<input type="password" name="password" class="form-control" required>
				</div>
				<button type="submit" class="btn btn-primary">Me connecter</button>
			</form>
	  	</div>
	</div>
</div>

<?php require "include/footer.php";
