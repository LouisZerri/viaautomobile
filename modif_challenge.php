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
	

	if(isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$challenge = recuperationChallengeById($_GET['id']);
	}

	$donnees = is_vainqueur();

	if(!empty($_POST))
	{
		$errors = array();

		if(!is_numeric($_POST['en_cours']) && ($_POST['en_cours'] != 0 || $_POST['en_cours'] != 1))
		{
			$errors['erreur'] = "La valeur doit être 1 ou 0";
		}

		if(empty($errors))
		{
			updateChallenge($_GET['id'], $_POST['titre'],$_POST['periode'],$_POST['description'],$challenge->image, $_POST['en_cours'], $_POST['vainqueur'], $challenge->image_accueil);
			$_SESSION['flash']['success'] = 'Le challenge a bien été modifié';
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
	width: 60%;
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

	.container
	{
		width: 100%;
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

	.container
	{
		width: 100%;
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

	table
	{
		width: 50%;
		margin-left: 150px;
	}

	.container
	{
		width: 100%;
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
		margin-left: 150px;
		
	}

	form > button
	{
		margin-bottom: 20px;
	}

	table
	{
		width: 40%;
		margin-left: 250px;
		margin-right: 20px;
	}

	.container
	{
		margin-left: 150px;
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
		padding-left: 150px;
	}

	form
	{
		margin-left: 150px;
	}

	table
	{
		width: 40%;
		margin-left: 250px;
		margin-right: 20px;
	}

	.container
	{
		margin-left: 150px;
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
		padding-left: 225px;
		width: 80%;
	}

	table
	{
		width: 40%;
		margin-left: 250px;
		margin-right: 20px;
	}

	.container
	{
		width: 100%;
	}
}
</style>
<div class="separation"></div>
<div class="menu">
	</br>
	</br>
	<a href="accueil.php"><img style="padding-left: 35px;" src="style/logo_final.png" alt="logo" width="250"></a></br></br></br>
	<p style="padding-left: 45px;color: #531B51;">Bonjour <b><?= $prenom; ?> <?= $nom; ?></b></p>
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
			<p>Vous n'avez pas rempli le formulaire correctement : </p>
			<ul>
				<?php foreach ($errors as $error): ?>
					<li style="list-style-type: disc;"><?= $error; ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
	<h3 style="color: #531B51;"><b>MODIFIER UN CHALLENGE</b></h3>
	<?php if(isset($_GET['id']) && is_numeric($_GET['id']) && $challenge): ?>
		<form style="width: 50%;" action="" method="POST" enctype="multipart/form-data">
			<div class="form-group mt-4">
				<label>Titre du challenge</label>
				<input type="text" name="titre" class="form-control" placeholder="Titre du challenge" value="<?= $challenge->titre ?>" required>
		    </div>
		    <div class="form-group">
				<label>Période du challenge</label>
				<input type="text" name="periode" class="form-control" placeholder="Exemple : mois de janvier" value="<?= $challenge->periode ?>" required>
		    </div>
		    <div class="form-group">
				<label>Description du challenge</label>
				<textarea class="form-control" name="description" rows="5" required><?= $challenge->description ?></textarea>
		    </div>
			<div class="form-group">
		        <label>Logo (JPG, PNG ou GIF | max. 15 Ko)</label>
		        <input class="form-control" id="logoFile" type="file" name="file" value="<?= $challenge->image ?>" size="30">
		    </div>
		    <div class="form-group">
		        <label>Image en page d'accueil</label>
		        <input class="form-control" id="logoFile" type="file" name="file_accueil" value="<?= $challenge->image_accueil ?>" size="30">
		    </div>
		    <div class="form-group">
				<label>Le challenge est-il passé ? Si oui, taper 0 (valeur par défaut : 1)</label>
				<input type="text" name="en_cours" class="form-control" placeholder="Inscrire 0 si le challenge est déjà passé" value="<?= $challenge->en_cours ?>" required>
		    </div>
		    <div class="form-group">
		    	<label>Qui est le vainqueur du challenge ?</label>
				<select class="form-control" name="vainqueur" placeholder="Site de ratachement">
					<option selected="selected">Choisir le vainqueur du challenge</option>
		        	<?php foreach($donnees as $data): ?>
		        		<option><?= $data->prenom ?> <?= $data->nom ?> avec <?= $data->nombre ?> mandats et <?= $data->vente ?> ventes</option>
		        	<?php endforeach; ?>
				</select>
			</div>
			<button style="background-color: #9D1458;" type="submit" class="btn btn-outline-light mt-3"><span style="color: white;">Modifier</span></button>
		</form>
	<?php else: ?>
		<div class="alert alert-warning mt-5" role="alert">
 			<i class="fa fa-warning"></i>&nbsp;&nbsp;Erreur dans la modification du challenge, veuillez réessayer
 			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    			<span aria-hidden="true">&times;</span>
  			</button>
		</div>
	<?php endif; ?>
</div>

<?php require "include/footer.php"; ?>