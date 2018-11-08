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

		if(empty($errors))
		{
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
	<h1>Creation de compte</h1>
	<form action="" method="POST">
		<div class="form-group">
			<label for=""><i class="fa fa-id-card-o"></i>&nbsp;&nbsp;Nom : </label>
			<input type="text" name="nom" class="form-control" placeholder="Exemple : Dupont" required>
		</div>
		<div class="form-group">
			<label for=""><i class="fa fa-address-card-o"></i>&nbsp;&nbsp;Prénom : </label>
			<input type="text" name="prenom" class="form-control" placeholder="Exemple : Jean" required>
		</div>
		<div class="form-group">
			<label for=""><i class="fa fa-birthday-cake"></i>&nbsp;&nbsp;Date de naissance : </label>
			<input type="text" name="naissance" class="form-control" placeholder="Format : JJ/MM/AAAA" required>
		</div>
		<div class="form-group">
			<label for=""><i class="fa fa-phone"></i>&nbsp;&nbsp;Portable : </label>
			<input type="text" name="telephone" class="form-control" required>
		</div>
		<div class="form-group">
			<label for=""><i class="fa fa-map-marker"></i>&nbsp;&nbsp;Site de ratachement : </label>
			<input type="text" name="site" class="form-control" required>
		</div>
		<div class="form-group">
			<label for=""><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Email : </label>
			<input type="text" name="email" class="form-control" required>
		</div>
		<div class="form-group">
			<label for=""><i class="fa fa-key"></i>&nbsp;&nbsp;Mot de passe : 
				<ul style="color: red;">
					Votre mot de passe doit contenir :
					<li id="compteur">9 caractère minimum</li>
					<li id="majuscule">Une majuscule</li>
					<li id="minuscule">Une minuscule</li>
					<li id="caractere">Un caractère spéciale</li>
					<li id="chiffre">Un chiffre</li>
				</ul>
			</label>
			<input id="password" type="password" name="password" class="form-control" pattern=".{9,}" required title="9 caracteres minimum" required>
		</div>

		<button type="submit" class="btn btn-primary">Enregistrer</button>
	</form>
	
	</br>
</div>
</br>

<script type="text/javascript">
	
	$(document).ready(function(){
		$('#password').on('input',function(e){
			if($(this).val() == "9")
			{
				$('#chiffre').hide();
			}
		})
		
	});






</script>


<?php require "include/footer.php"; ?>