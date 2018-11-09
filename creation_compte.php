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

		if(!preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $_POST['telephone']))
		{
			$errors['telephone'] = "Le numéro de téléphone n'est pas valide";
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

			insertVendeur($_POST['nom'],$_POST['prenom'],$_POST['naissance'],$_POST['site'],$_POST['email'],$_POST['password'],$_POST['telephone']);

			$_SESSION['flash']['success'] = 'Enregistrement réalisé avec succès';
			header('Location: creation_compte.php');
		}
	}

?>

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
	
	<div style="width: 40%; margin-left: auto; margin-right: auto;">
		<center><h1>Creation de compte</h1></center>
		</br>
		<form action="" method="POST">
			<div class="form-group">
				<input type="text" name="nom" class="form-control" placeholder="Nom" required>
			</div>
			<div class="form-group">
				<input type="text" name="prenom" class="form-control" placeholder="Prénom" required>
			</div>
			<div class="form-group">
				<input type="text" name="naissance" class="form-control" placeholder="Date de naissance" required>
			</div>
			<div class="form-group">
				<input type="text" name="telephone" class="form-control" placeholder="Portable" required>
			</div>
			<div class="form-group">
				<input type="text" name="site" class="form-control" placeholder="Site de ratachement" required>
			</div>
			<div class="form-group">
				<input type="text" name="email" class="form-control" placeholder="Adresse email" required>
			</div>
			<div class="form-group">
				<div class="input-group mb-3">
  					<input id="password" type="password" name="password" class="form-control" pattern=".{9,}" required title="9 caracteres minimum" placeholder="Choissisez un mot de passe" required>
  					<div class="input-group-append">
   						 <button class="btn btn-danger" type="button" id="button-addon2">Non valide</button>
  					</div>
				</div>
				<div id="hide" style="border: 1px solid red; border-radius: 5px; outline: none; border-color: #9ecaed; box-shadow: 0 0 10px #9ecaed;">
					<span style="font-weight: bold; font-size: 15px;" id="c">&nbsp;Votre mot de passe doit comporter au moins 9 caractères</span>
					<span style="font-weight: bold; font-size: 15px;" id="M">&nbsp;Votre mot de passe doit comporter au moins une majuscule</br></span>
					<span style="font-weight: bold; font-size: 15px;" id="m">&nbsp;Votre mot de passe doit comporter au moins une minuscule</br></span>
					<span style="font-weight: bold; font-size: 15px;" id="0">&nbsp;Votre mot de passe doit comporter au moins un chiffre</br></span>
					<span style="font-weight: bold; font-size: 15px;" id="caractere">&nbsp;Votre mot de passe doit comporter au moins un caractère &nbsp;spécial</span>
				</div>
			</div>
			<div class="form-group">
				<input type="password" name="password_confirm" class="form-control" placeholder="Confirmez le mot de passe" required>
			</div>
			<center>
				<button type="submit" class="btn btn-primary">Enregistrer</button>
			</center>
		</form>
	</div>
	</br>
</div>
</br>

<?php require "include/footer.php"; ?>