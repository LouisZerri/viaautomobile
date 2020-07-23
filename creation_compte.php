
<?php 

	session_start();

	require 'include/header.php';
	require 'include/functions.php';
	require 'bdd/database.php';

	$donnees = recupereSiteRattachement();

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

		if(is_numeric($_POST['enseigne']))
		{
			$errors['enseigne'] = "L'enseigne ne peut pas être une valeur numérique";
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

			$token = str_random(60);

			insertVendeur($_POST['nom'],$_POST['prenom'],$_POST['naissance'],$_POST['site'],$_POST['enseigne'],$_POST['email'],$_POST['password'],$_POST['telephone'],$token);

			$user_id = recupererDernierID();

			sendEmailForConfirmation($_POST['email'],$user_id->last_id, $token);

			header('Location: valide_inscription.php');
		}
	}

?>
<style>

	@media screen and (min-width: 1080px) and (max-width: 1360px) {
  		.card {
    		position: absolute; 
			width: 20%; 
			height: 80%; 
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
			width: 20%; 
			height: 80%; 
			top:0; 
			bottom:0; 
			left:0; 
			right: 0; 
			margin: auto;
			border-radius: 15px;
  		}
	}

	/*Pour les tablettes et ipad */

	@media (min-width: 768px) and (max-width: 1024px) 
	{
		.card {
    		position: absolute; 
			width: 40%; 
			height: 60%; 
			top:0; 
			bottom:0; 
			left:0; 
			right: 0; 
			margin: auto;
			border-radius: 15px;
  		}
	}
	@media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) 
	{
		.card {
    		position: absolute; 
			width: 40%; 
			height: 95%; 
			top:0; 
			bottom:0; 
			left:0; 
			right: 0; 
			margin: auto;
			border-radius: 15px;
  		}
	}

	@media only screen and (min-device-width: 1366px) and (max-device-height: 1024px) and (-webkit-min-device-pixel-ratio: 2)  and (orientation: landscape)
	{
		.card {
    		position: absolute; 
			width: 30%; 
			height: 75%; 
			top:0; 
			bottom:0; 
			left:0; 
			right: 0; 
			margin: auto;
			border-radius: 15px;
  		}
	}

</style>
<img style="right: 0; padding-bottom: 170px; opacity: 50%; position: fixed;" src="style/logo_blanc.svg" alt="logo" width="250" height="250">
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
	
	<div id="creation_compte" class="card">
		<center>
			</br>
			<img src="style/logo_couleur.svg" alt="logo" width="300" height="75">
			</br>
		</center>	
		<div class="card-body">
			<center><h5><b>CRÉATION DE COMPTE</b></h5></center>
			</br>
			<?php if(!empty($_POST)): ?>
				<form action="" method="POST">
					<div class="form-group">
						<input type="text" name="nom" class="form-control is-invalid" placeholder="Nom" value="<?php echo $_POST['nom']; ?>" required>
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
						<input type="text" name="enseigne" class="form-control" placeholder="Enseigne" value="<?php echo $_POST['enseigne']; ?>" required>
					</div>
					<div class="form-group">
	 					<select class="form-control" name="site" placeholder="Site de ratachement">
	 						<option selected="selected"><?php echo $_POST['site']; ?></option>
	 						<?php foreach($donnees as $site): ?>
								<option><?= $site->site_rattachement ?></option>
	 						<?php endforeach; ?>
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
					<input type="text" name="enseigne" class="form-control" placeholder="Enseigne" required>
				</div>
				<div class="form-group">
 					<select class="form-control" name="site" placeholder="Site de ratachement">
 						<option selected="selected" disabled selected hidden>Site de ratachement</option>
			        	<?php foreach($donnees as $site): ?>
							<option><?= $site->site_rattachement ?></option>
 						<?php endforeach; ?>
    				</select>
  				</div>
				<div class="form-group">
					<input type="text" name="email" class="form-control" placeholder="Adresse email" required>
				</div>
				<div class="form-group">
					<div class="input-group mb-3">
	  					<input id="password" data-toggle="popover" title="Caractéristiques du mot de passe" data-content="<ul><li>Une majuscule</li><li>Une minuscule</li><li>Un chiffre</li><li>Un caractère spécial</li><li>Minimum 9 caractères</li></ul>" data-html="true" type="password" name="password" class="form-control" pattern=".{9,}" required title="9 caracteres minimum" placeholder="Choissisez un mot de passe" required>
	  				</div>
				</div>
				<div class="form-group">
					<input type="password" name="password_confirm" class="form-control" placeholder="Confirmez votre mot de passe" required>
				</div>
				<center></br>
					<button id="boutons" style="background-color: #9D1458;" type="submit" class="btn btn-light"><span style="color: white;">Inscription</span></button>
				</center>
			</form>
		<?php endif; ?>
		</div>
	</div>
</div>
</br>
<div id="fin">
	<p>Powered by Pepperbay</p>
</div>

<script type="text/javascript">

function formatDate(date)
{
	var string = date.split("/");

	var newdate = string.join("");

	if(newdate.length == 8)
	{
		return true;
	}
	
	return false;
}

$(document).ready(function() {

	$('input[name="nom"]').change(function(){
		var nom = $(this).val();
		
		if(nom != undefined && nom != "")
		{
			$(this).css({"border-color":"#00E500","border-width":"thin"})
		}
		else
		{
			$(this).css({"border-color":"#FF0000","border-width":"thin"})
		}

	})

	$('input[name="prenom"]').change(function(){
		var prenom = $(this).val();
		
		if(prenom != undefined && prenom != "")
		{
			$(this).css({"border-color":"#00E500","border-width":"thin"})
		}
		else
		{
			$(this).css({"border-color":"#FF0000","border-width":"thin"})
		}

	})
	
	$('input[name="naissance"]').change(function(){
		var naissance = $(this).val();
		
		if(naissance != undefined && naissance != "" && formatDate(naissance))
		{
			$(this).css({"border-color":"#00E500","border-width":"thin"})
		}
		else
		{
			$(this).css({"border-color":"#FF0000","border-width":"thin"})
		}

	})

	$('input[name="telephone"]').change(function(){
		var telephone = $(this).val();

		tel = telephone.replace(/[\.,\s]/g, '');

		if(telephone != undefined && telephone != "" && tel.match(/^(\+33|0033|0)(6|7)[0-9]{8}$/g))
		{
			$(this).css({"border-color":"#00E500","border-width":"thin"})
		}
		else
		{
			$(this).css({"border-color":"#FF0000","border-width":"thin"})
		}

	})

	$('input[name="enseigne"]').change(function(){
		var enseigne = $(this).val();
		
		if(enseigne != undefined && enseigne != "")
		{
			$(this).css({"border-color":"#00E500","border-width":"thin"})
		}
		else
		{
			$(this).css({"border-color":"#FF0000","border-width":"thin"})
		}

	})

	$('select[name="site"]').change(function(){
		var site = $(this).val();

		if(site != undefined && site != "")
		{
			$(this).css({"border-color":"#00E500","border-width":"thin"})
		}
		else
		{
			$(this).css({"border-color":"#FF0000","border-width":"thin"})
		}

	})

	$('input[name="email"]').change(function(){
		var email = $(this).val();

		if(email != undefined && email != "" && email.match(/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i))
		{
			$(this).css({"border-color":"#00E500","border-width":"thin"})
		}
		else
		{
			$(this).css({"border-color":"#FF0000","border-width":"thin"})
		}

	})

	$('[data-toggle="popover"]').popover()

	$('input[name="password"]').change(function(){
		var data = $(this).attr("data-content")

		var content = $(this).val();

		var reg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{9,}$/;

		if(reg.test(content))
		{
			$(this).css({"border-color":"#00E500","border-width":"thin"})
		}
		else
		{
			$(this).css({"border-color":"#FF0000","border-width":"thin"})
		}
	})

	$('input[name="password_confirm"]').change(function(){
		var mdp_confirm = $(this).val();
		var mdp = $('input[name="password"]').val();

		if(mdp_confirm != undefined && mdp_confirm != "" && mdp_confirm == mdp)
		{
			$(this).css({"border-color":"#00E500","border-width":"thin"})
		}
		else
		{
			$(this).css({"border-color":"#FF0000","border-width":"thin"})
		}

	})





})
</script>
<?php require "include/footer.php"; ?>