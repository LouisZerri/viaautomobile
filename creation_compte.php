
<?php 

	session_start();

	require 'include/header.php';
	require 'include/functions.php';

	if(!empty($_POST))
	{
		$errors = array();

		require_once 'bdd/database.php';

		if(is_numeric($_POST['nom']))
		{
			$errors['nom'] = "Votre nom ne peut pas être une valeur numérique";
		}

		if(is_numeric($_POST['prenom']))
		{
			$errors['prenom'] = "Votre prénom ne peut pas être une valeur numérique";
		}

		if(!formatDate($_POST['naissance']))
		{
			$errors['naissance'] = "Votre date de naissance doit être au format JJ/MM/AAAA";
		}

		if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			$errors['email'] = "Votre email n'est pas valide";
		}
		else
		{
			
			if(checkEmail($_POST['email']))
			{
				$errors['email'] = "Cet email est déjà utilisé pour un autre compte";
			}
		}

		if(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{9,}$#', $_POST['password'])) 
		{
		 	$errors['password'] = "Le mot de passe n'est pas sécurisé";
		}

		if($_POST['password'] != $_POST['password_confirm'])
		{
			$errors['password_confirm'] = "Les deux mots de passe ne correspondent pas";
		}

		if(empty($errors))
		{
			$_POST['telephone'] = formatTelephone($_POST['telephone']);

			insertVendeur($_POST['nom'],$_POST['prenom'],$_POST['naissance'],$_POST['site'],$_POST['email'],$_POST['password'],$_POST['telephone'],0);

			header('Location: valide_inscription.php');
		}
	}

?>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<style>
	html, body { 
	  margin:0;
	  padding:0;
	  font-family: 'Montserrat';
	  background: url(style/fond.png) no-repeat center fixed; 
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

	.form-control
	{
		font-size: 10px;
	}

	.card
	{
		width: 40%;
		margin-left: 325px;
		margin-top: 75px;
	}
</style>
<img style="float: right; padding-bottom: 150px; opacity: 50%;" src="style/logo_blanc.svg" alt="logo" width="250" height="250">
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
	
	<div class="card">
		<center>
			</br>
			<img src="style/logo_couleur.png" alt="logo" width="200" height="50">
			</br>
			</br>
		</center>	
		<div class="card-body">
			<center><h5><b>CRÉATION DE COMPTE</b></h5></center>
			</br>
			<?php if(!empty($_POST)): ?>
				<form action="" method="POST">
					<div class="form-group">
						<input type="text" name="nom" class="form-control" placeholder="Nom" value="<?php echo $_POST['nom']; ?>" required>
					</div>
					<div class="form-group">
						<input type="text" name="prenom" class="form-control" placeholder="Prénom" value="<?php echo $_POST['prenom']; ?>" required>
					</div>
					<div class="form-group">
						<input type="text" name="naissance" class="form-control" placeholder="Date de naissance (JJ/MM/AAAA)" value="<?php echo $_POST['naissance']; ?>" required>
					</div>
					<div class="form-group">
						<input type="text" name="telephone" class="form-control" placeholder="Téléphone portable (+33)" value="<?php echo $_POST['telephone']; ?>" required>
					</div>
					<div class="form-group">
	 					<select class="form-control" name="site" placeholder="Site de ratachement">
	 						<option selected="selected"><?php echo $_POST['site']; ?></option>
				        	<option>Paris</option>
				        	<option>Lyon</option>
				        	<option>Marseille</option>
				       		<option>Lille</option>
				      		<option>Bordeaux</option>
				      		<option>Toulouse</option>
				      		<option>Strasbourg</option>
	    				</select>
	  				</div>
					<div class="form-group">
						<input type="text" name="email" class="form-control" placeholder="Adresse email" value="<?php echo $_POST['email']; ?>" required>
					</div>
					<div class="form-group">
						<div class="input-group mb-3">
		  					<input id="password" type="password" name="password" class="form-control" pattern=".{9,}" required title="9 caracteres minimum" placeholder="Choissisez un mot de passe" required>
		  				</div>
					</div>
					<div class="form-group">
						<input type="password" name="password_confirm" class="form-control" placeholder="Confirmez votre mot de passe" required>
					</div>
					<center>
						<button style="background-color: #9D1458;" type="submit" class="btn btn-light"><span style="color: white;">Inscription</span></button>
					</center>
				</form>
			<?php else: ?>
				<form action="" method="POST">
				<div class="form-group">
					<input type="text" name="nom" class="form-control" placeholder="Nom" required>
				</div>
				<div class="form-group">
					<input type="text" name="prenom" class="form-control" placeholder="Prénom" required>
				</div>
				<div class="form-group">
					<input type="text" name="naissance" class="form-control" placeholder="Date de naissance (JJ/MM/AAAA)" required>
				</div>
				<div class="form-group">
					<input type="text" name="telephone" class="form-control" placeholder="Téléphone portable (+33)" required>
				</div>
				<div class="form-group">
 					<select class="form-control" name="site" placeholder="Site de ratachement">
 						<option selected="selected" disabled selected hidden>Site de ratachement</option>
			        	<option>Paris</option>
			        	<option>Lyon</option>
			        	<option>Marseille</option>
			       		<option>Lille</option>
			      		<option>Bordeaux</option>
			      		<option>Toulouse</option>
			      		<option>Strasbourg</option>
    				</select>
  				</div>
				<div class="form-group">
					<input type="text" name="email" class="form-control" placeholder="Adresse email" required>
				</div>
				<div class="form-group">
					<div class="input-group mb-3">
	  					<input id="password" type="password" name="password" class="form-control" pattern=".{9,}" required title="9 caracteres minimum" placeholder="Choissisez un mot de passe" required>
	  				</div>
				</div>
				<div class="form-group">
					<input type="password" name="password_confirm" class="form-control" placeholder="Confirmez votre mot de passe" required>
				</div>
				<center>
					<button style="background-color: #9D1458;" type="submit" class="btn btn-light"><span style="color: white;">Inscription</span></button>
				</center>
			</form>
		<?php endif; ?>
		</div>
	</div>
</div>
</br>
<?php require "include/footer.php"; ?>