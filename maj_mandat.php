<?php 
	
	require "include/header.php";
	require "bdd/database.php";
	require "include/functions.php";

	logged_only();
	erreurs();

	$nom = $_SESSION['auth']->nom;
	$prenom = $_SESSION['auth']->prenom;
	$email = $_SESSION['auth']->email;

	adminOnly($droit, $email);
	$errors = array();

	if(!empty($_POST))
	{
		if(!is_numeric($_POST['compteur']))
		{
			$errors['nombre'] = "Le nombre de mandat doit être une valeur numérique";
		}

		if($_POST['compteur'] != 0)
		{
			$errors['actualisation'] = "Le nombre de mandat doit être égale à 0";
		}

		if(empty($errors))
		{
			mettreMandatAZero($_POST['compteur']);
			//supprimeHistorique();
			$_SESSION['flash']['success'] = 'Tous les mandats ont été remis à 0';
			header('Location: op_challenge.php');
		}
	}

?>
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

.container
{
	margin-left: 270px;
}

.separation
{
	margin-left: 280px;
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
		padding-top: 10px;
		zoom: 125%;
	}
}

/* 
##Device = Tablets, Ipads (portrait)
##Screen = B/w 768px to 1024px
*/

@media (min-width: 768px) and (max-width: 1024px) 
{
	h3
	{
		bottom:0; 
		left:0;
		top: 0;
		right:0;  
		margin: auto;
		padding-top: 50px;
		padding-left: 150px;
	}

	form
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
	h3
	{
		bottom:0; 
		left:0;
		top: 0;
		right:0;  
		margin: auto;
		padding-top: 50px;
		padding-left: 300px;
	}

	form
	{
		padding-left: 100px;
	}
}

/* Ipad Pro */
@media only screen and (min-device-width: 1024px) and (max-device-height: 1366px) and (-webkit-min-device-pixel-ratio: 2)  and (orientation: portrait)
{
	h3
	{
		bottom:0; 
		left:0;
		top: 0;
		right:0;  
		margin: auto;
		padding-top: 50px;
		padding-left: 250px;
	}

	form
	{
		margin-left: 320px;
	}
}

@media only screen and (min-device-width: 1366px) and (max-device-height: 1024px) and (-webkit-min-device-pixel-ratio: 2)  and (orientation: landscape)
{
	h3
	{
		bottom:0; 
		left:0;
		top: 0;
		right:0;  
		margin: auto;
		padding-top: 50px;
		padding-left: 200px;
	}

	form
	{
		padding-left: 250px;
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
		<li><a id="change" href="op_challenge.php"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;Mettre à jour les challenges</a></li></br>
		<li><a id="change" href="maj_mandat.php"><i class="fa fa-circle-o-notch" aria-hidden="true"></i>&nbsp;Mettre à jour les mandats</a></li></br>
		<li><a id="change" href="maj_vente.php"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;Mettre à jour les ventes</a></li></br>
		<li><a id="change" href="tableau_de_bord.php"><i class="fa fa-car" aria-hidden="true"></i>&nbsp;Revenir sur viaautomobile</a></li></br>
		<li><a id="change" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Deconnexion</a></li></br>
	</ul>
	<img style="position: fixed; left: 0; bottom: 0; padding-left: 15px;" src="style/logo_gris.svg" alt="logo" width="230">
</div>
<div class="container">
	<?php if(!empty($errors)): ?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    			<span aria-hidden="true">&times;</span>
  			</button>
			<p>Vous n'avez pas rempli le formulaire correctement : </p>
			<ul>
				<?php foreach ($errors as $error): ?>
					<li style="list-style-type: disc;"><?= $error; ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
	<h3 style="color: #531B51;"><b>MODIFIER LES MANDATS</b></h3>
	<form style="width: 50%;" action="" method="POST">
		<div class="form-group mt-4">
			<label style="color: #531B51;">Remettre tous les mandats à 0 : </label>
			<input type="text" name="compteur" class="form-control" placeholder="Mettre les mandats à 0" required>
	    </div>
		<button style="background-color: #9D1458;" type="submit" class="btn btn-outline-light mt-3"><span style="color: white;">Modifier</span></button>
	</form>
</div>

<?php require "include/footer.php"; ?>