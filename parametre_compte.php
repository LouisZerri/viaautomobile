<?php 
	
	require "include/header.php";
	require "bdd/database.php";
	require "include/functions.php";

	logged_only();

	$nom = $_SESSION['auth']->nom;
	$prenom = $_SESSION['auth']->prenom;
	$email = $_SESSION['auth']->email;

	$vendeur = recupInfoVendeur($nom);

	if(!empty($_POST))
	{
		$errors = array();

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

		if($_POST['site'] == '')
		{
			$_POST['site'] = $vendeur->site_ratachement;
		}

		if(is_numeric($_POST['enseigne']))
		{
			$errors['enseigne'] = "L'enseigne ne peut pas être une valeur numérique";
		}

		if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			$errors['email'] = "Votre email n'est pas valide";
		}

		if($_POST['password'] != $_POST['confirm_password'])
		{
			$errors['confirm_password'] = "Les deux mots de passe ne correspondent pas";
		}

		if(empty($errors))
		{
			updateVendeur($_POST['nom'],$_POST['prenom'],$_POST['naissance'],$_POST['site'],$_POST['enseigne'],$_POST['email'],$_POST['new_password'],$_POST['telephone']);
			$_SESSION['flash']['success'] = 'Votre compte a bien été modifié';
			header('Location: tableau_de_bord.php');
		}
	}

?>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<style>

html, body
{
	font-family: 'Montserrat';
	text-decoration: none;
	list-style-type: none;
	background: white;
}

.form-control
{
	font-size: 15px;
}

label
{
	color: #808080;
}



form, #cache
{
	margin-left: 300px;
	margin-bottom: 20px;
}

h3
{
	margin-left: 200px;
}

@media screen and (min-width: 1080px) and (max-width: 1360px) {

	.separation
	{
		
		position: absolute;
		margin-left: 300px;
		height: 100%;
		width: 1px;
		background: grey;
		top: 0;
		bottom: 0;
		opacity: 0.2;
	}

	h3
	{
		bottom:0; 
		left:0;
		top: 0;
		right:0;  
		margin: auto;
		padding-top: 50px;
		zoom: 125%;
	}

	.form-group, .form-control
	{
		font-size: 12px;
	}
}

@media screen and (min-height: 770px) and (max-height: 1920px) {

	.separation
	{
		
		position: absolute;
		margin-left: 300px;
		height: 100%;
		width: 1px;
		background: grey;
		top: 0;
		bottom: 0;
		opacity: 0.2;
	}

	h3
	{
		bottom:0; 
		left:0;
		top: 0;
		right:0;  
		margin: auto;
		padding-top: 50px;
		zoom: 125%;
	}

	.form-group, .form-control
	{
		font-size: 12px;
	}


}

/* 
	##Device = Tablets, Ipads (portrait)
	##Screen = B/w 768px to 1024px
	*/

	@media (min-width: 768px) and (max-width: 1024px) 
	{

		h3 > b
		{
			margin-left: 150px;
		}

		form, #cache
		{
			margin-left: 200px;
		}

	}

	/* 
	##Device = Tablets, Ipads (landscape)
	##Screen = B/w 768px to 1024px
	*/

	@media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) 
	{
		h3 > b
		{
			margin-left: 100px;
		}

		form, #cache
		{
			margin-left: 300px;
			margin-bottom: 20px;
		}

		.separation
		{
			
			position: fixed;
			margin-left: 300px;
			height: 100%;
			width: 1px;
			background: grey;
			top: 0;
			bottom: 0;
			opacity: 0.2;
		}

		.menu
		{
			width: 300px;
			height: 400px;
			float: left;
			position: fixed;

		}
	}

	/* Ipad Pro */
	@media only screen and (min-device-width: 1024px) and (max-device-height: 1366px) and (-webkit-min-device-pixel-ratio: 2)  and (orientation: portrait)
	{
		h3 > b
		{
			margin-left: 220px;
		}

		form, #cache
		{
			margin-left: 280px;
		}
	}

	@media only screen and (min-device-width: 1366px) and (max-device-height: 1024px) and (-webkit-min-device-pixel-ratio: 2)  and (orientation: landscape)
	{
		h3 > b
		{
			margin-left: 200px;
		}

		form, #cache
		{
			margin-left: 250px;
			margin-bottom: 20px;
		}

		.separation
		{
			
			position: fixed;
			margin-left: 300px;
			height: 100%;
			width: 1px;
			background: grey;
			top: 0;
			bottom: 0;
			opacity: 0.2;
		}

		.menu
		{
			width: 300px;
			height: 400px;
			float: left;
			position: fixed;

		}
	}
</style>
<div class="separation"></div>
<div class="menu">
	</br>
	</br>
	<a href="accueil.php"><img style="padding-left: 35px;" src="style/logo_final.png" alt="logo" width="250"></a></br></br></br>
	<p style="padding-left: 45px; color: #531B51;">Bonjour <b><?= $prenom; ?> <?= $nom; ?></b></p>
	</br>
	<ul>
		<li><a id="change" href="challenges.php"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;Les challenges</a></li></br>
		<li><a id="change" href="tableau_de_bord.php"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Mon tableau de bord</a></li></br>
		<li><a id="change" href="historique.php"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;Historique</a></li></br>
		<?php if(in_array($email, $droit)) :?>
			<li><a id="change" href="backoffice.php"><i class="fa fa-pie-chart" aria-hidden="true"></i>&nbsp;Administration</a></li></br>
		<?php endif; ?>
		<li><a id="change" href="parametre_compte.php"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;Paramètres du compte</a></li></br>
		<li><a id="change" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Deconnexion</a></li></br>
	</ul>
	<img style="position: fixed; left: 0; bottom: 0; padding-left: 15px;" src="style/logo_gris.svg" alt="logo" width="230">
</div>
<div class="container">
	<?php if(!empty($errors)): ?>
		<div class="alert alert-danger">
			<p>Vous n'avez pas rempli le formulaire correctement : </p>
			<ul>
				<?php foreach ($errors as $error): ?>
					<li style="list-style-type: disc;"><?= $error; ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
	<h3 style="color: #531B51;"><b>PARAMÈTRES DU COMPTE</b></h3>
	<form style="width: 30%; padding-top: 30px;" action="" method="POST">
		<div class="form-group">
			<label>Mon nom</label>
			<input id="1" type="text" name="nom" class="form-control" placeholder="Nom" value="<?php echo $vendeur->nom; ?>" readonly>
		</div>
		<div class="form-group">
			<label>Mon prénom</label>
			<input id="2" type="text" name="prenom" class="form-control" placeholder="Prénom" value="<?php echo $vendeur->prenom ?>" readonly>
		</div>
		<div class="form-group">
			<label>Ma date de naissance</label>
			<input id="3" type="text" name="naissance" class="form-control" placeholder="Date de naissance (JJ/MM/AAAA)" value="<?php echo $vendeur->date_naissance; ?>" readonly>
		</div>
		<div class="form-group">
			<label>Mon téléphone</label>
			<input id="4" type="text" name="telephone" class="form-control" placeholder="Téléphone portable (+33)" value="<?php echo $vendeur->portable; ?>" readonly>
		</div>
		<div class="form-group">
			<label>Enseigne</label>
			<input id="5" type="text" name="enseigne" class="form-control" placeholder="Enseigne" value="<?php echo $vendeur->enseigne; ?>" readonly>
		</div>
		<div class="form-group">
			<label>Site de ratachement</label>
			<select id="6" class="form-control" name="site" placeholder="Site de ratachement" disabled>
				<option selected="selected" disabled selected hidden><?= $vendeur->site_ratachement; ?></option>
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
			<label>Mon adresse email</label>
			<input id="7" type="text" name="email" class="form-control" placeholder="Adresse email" value="<?php echo $vendeur->email; ?>" readonly>
		</div>
		<div class="form-group">
			<label id="ancien">Mot de passe</label>
			<input id="8" type="password" name="password" class="form-control" placeholder="Mot de passe" value="<?php echo substr($vendeur->mot_de_passe, 0,10); ?>" readonly>
		</div>
	</form>
	<button id="cache" style="background-color: #754974;" type="submit" class="btn btn-light mb-2"><span style="color: white;">Modifier</span></button>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('button').click(function(){

			for(var i = 1; i <= 8; i++)
			{
				$('#'+i).removeAttr('readonly');
			}

			$('#6').removeAttr('disabled');
			$('#ancien').html('Ancien mot de passe');
			$('#8').attr('value','');
			$('form').append('<div class="form-group"><label>Nouveau mot de passe</label><input type="password" name="new_password" class="form-control" placeholder="Nouveau mot de passe">')
			$('form').append('<div class="form-group"><label>Confirmation du nouveau mot de passe</label><input type="password" name="confirm_password" class="form-control" placeholder="Confirmation du nouveau mot de passe">')
			$('form').append('<button style="background-color: #754974;" type="submit" class="btn btn-light mb-2"><span style="color: white;">Valider</span></button');
			$('#cache').hide();
		})


	})



</script>
<?php require "include/footer.php"; ?>