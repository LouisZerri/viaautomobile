<?php 


	require "include/header.php";
	require "include/functions.php";
	require  "bdd/database.php";

	logged_only();
	erreurs();

	$nom = $_SESSION['auth']->nom;
	$prenom = $_SESSION['auth']->prenom;

	$donnees = recuperationToutLesChallenges();

	$delete_challenge = "delete_challenge.php?id=";
	$modif_challenge = "modif_challenge.php?id=";

	if(!empty($_POST))
	{
		$errors = array();

		if(is_numeric($_POST['titre']))
		{
			$errors['titre'] = "Le titre du challenge ne peut pas être une valeur numérique";
		}

		if(is_numeric($_POST['periode']))
		{
			$errors['periode'] = "La période du challenge ne peut pas être une valeur numérique";
		}

		if(isset($_FILES['file']) && $_FILES['file']['error'] == 0)
		{
			$infosfichier = pathinfo($_FILES['file']['name']);
			$name = $infosfichier['filename'];
			$extension_upload = strtolower($infosfichier['extension']);
			$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

			if(!in_array($extension_upload, $extensions_autorisees))
			{
				$errors['file'] = "L'extension du fichier est incorrecte";
			}
			else
			{
				$repertoireDestination = "/var/www/html/viaautomobile.pepperbay.fr/style";
				$nomDestination = "$name.$extension_upload";
				$file = "$repertoireDestination/$nomDestination";
				if(is_uploaded_file($_FILES["file"]["tmp_name"])) 
	    		{
		        	$resultat = move_uploaded_file($_FILES['file']['tmp_name'], $file);
		        }
		    }	
		}


		if(empty($errors) && $resultat)
		{

			insertChallenge($_POST['titre'],$_POST['periode'],$_POST['description'],$nomDestination);
			$_SESSION['flash']['success'] = 'Le challenge a été ajouté avec succès';
			header('Location: op_challenge.php');
		}
	}


?>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<style>
body
{
	font-family: 'Montserrat';
	text-decoration: none;
	list-style-type: none;
	color: #531B51;
}
.menu
{
	width: 300px;
	height: 400px;
	float: left;
	z-index:10;
	position: fixed;

}

.separation
{
	
	position: fixed;
	margin-left: 270px;
	height: 100%;
	width: 1px;
	background: grey;
	top: 0;
	bottom: 0;
	opacity: 0.2;
}

li
{
	list-style-type: none;
	z-index:10;
}

span
{
	color: white;
	z-index: 10;
}

#change
{
	color: #531B51;
	text-decoration: none;
	list-style-type: none;
}

#change:hover
{
	color: white;
	transition:all 0.10s;
	border:none;
	padding: 10px 10px 10px 10px;
	border-radius: 20px;
	background: #754974;
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
</style>
<div class="separation"></div>
<div class="menu">
	</br>
	</br>
	<a href="accueil.php"><img style="padding-left: 35px;" src="style/logo_final.png" alt="logo" width="250"></a></br></br></br>
	<p style="padding-left: 45px;">Bonjour <b><?= $prenom; ?> <?= $nom; ?></b></p>
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

	<h3><b>METTRE A JOUR LES CHALLENGE</b></h3></br>
	<h4><b>Ajouter un challenge</b></h4>	
	<form style="width: 30%;" action="" method="POST" enctype="multipart/form-data">
		<div class="form-group mt-4">
			<label>Titre du challenge</label>
			<input type="text" name="titre" class="form-control" placeholder="Titre du challenge" required>
	    </div>
	    <div class="form-group">
			<label>Période du challenge</label>
			<input type="text" name="periode" class="form-control" placeholder="Exemple : mois de janvier" required>
	    </div>
	    <div class="form-group">
			<label>Description du challenge</label>
			<textarea class="form-control" name="description" required></textarea>
	    </div>
  		<div class="form-group">
            <label>Logo (JPG, PNG ou GIF | max. 15 Ko)</label>
            <input class="form-control" id="logoFile" type="file" name="file" size="30">
        </div>
		<button style="background-color: #9D1458;" type="submit" class="btn btn-outline-light mt-3"><span style="color: white;">Valider</span></button>
	</form></br></br>
	<h4><b>La liste des challenges</b></h4>	

	<table style="padding-left: 100px;" class="table table-striped mt-5">
		<thead>
			<tr>
  				<th align="center" scope="col">Titre du challenge</th>
		      	<th align="center" scope="col">Periode</th>
		      	<th align="center" scope="col">Modifier</th>
		      	<th align="center" scope="col">Supprimer</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($donnees as $data): ?>
				<tr>
					<td><?= $data->titre; ?></td>
					<td><?= $data->periode; ?></td>
					<td><a style="color: black;" href="<?= $modif_challenge."".$data->id_challenge ?>"><i class="fa fa-pencil"></i></a></td>
					<td><a id="delete_challenge" style="color: black;" href="<?= $delete_challenge."".$data->id_challenge ?>"><i class="fa fa-trash"></i></a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

		$("a[id='delete_challenge']").click(function(e){

			e.preventDefault();

			var $a = $(this)

			var url = $a.attr('href')

			jQuery.ajax({
				url : url,
				type : 'GET',
				success: function()
				{
					$a.parents('tr').fadeOut();
				},
				error: function(jqxhr)
				{
					alert(jqxhr.responseText);
				}
			});
		});
	})
</script>

<?php require "include/footer.php"; ?>
