<?php 


	require "include/header.php";
	require "include/functions.php";
	require  "bdd/database.php";

	logged_only();
	erreurs();

	$nom = $_SESSION['auth']->nom;
	$prenom = $_SESSION['auth']->prenom;
	$email = $_SESSION['auth']->email;


	$donnees = recuperationToutLesChallenges();

	$delete_challenge = "delete_challenge.php?id=";
	$modif_challenge = "modif_challenge.php?id=";

	adminOnly($droit, $email);

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
		
		position: fixed;
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
		
		position: fixed;
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
		padding-top: 10px;
		padding-left: 150px;
	}

	form
	{
		margin-left: 200px;
	}

	table
	{
		width: 90%;
		margin-left: 200px;
	}

	h4
	{
		padding-left: 200px;
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
		padding-top: 10px;
		padding-left: 250px;
	}

	form
	{
		margin-left: 250px;
	}

	table
	{
		width: 90%;
		margin-left: 250px;
	}

	h4
	{
		padding-left: 250px;
	}

	.container
	{
		width: 100%;
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
		padding-top: 10px;
		padding-left: 250px;
	}

	form
	{
		margin-left: 300px;
	}

	table
	{
		width: 90%;
		margin-left: 250px;
	}

	h4
	{
		padding-left: 300px;
	}

	.container
	{
		width: 100%;
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
		padding-top: 10px;
		padding-left: 200px;
	}

	form
	{
		margin-left: 250px;
	}

	table
	{
		width: 90%;
		margin-left: 250px;
	}

	h4
	{
		padding-left: 250px;
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

	<h3 style="color: #531B51;"><b>METTRE A JOUR LES CHALLENGES</b></h3></br>
	<h4 style="color: #531B51;"><b>Ajouter un challenge</b></h4>	
	<form style="width: 30%;" action="ajout_challenge.php" method="POST" enctype="multipart/form-data">
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
        <div class="form-group">
            <label>Image en page d'accueil</label>
            <input class="form-control" id="logoFile" type="file" name="file_accueil" size="30">
        </div>
		<button style="background-color: #9D1458;" type="submit" class="btn btn-outline-light mt-3"><span style="color: white;">Valider</span></button>
	</form></br></br>
	<h4 style="color: #531B51;"><b>La liste des challenges</b></h4>	

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
	</table></br>
	<div class="row">
		<div class="col">
			<h4 style="color: #531B51;"><b>Ajouter un site de rattachement</b></h4>
			<form action="ajout_site.php" method="POST">
				<div class="form-group mt-4">
					<label>Site de rattachement :</label>
					<input type="text" name="site" class="form-control" placeholder="Site de rattachement" required>
			    </div>
				<button style="background-color: #9D1458;" type="submit" class="btn btn-outline-light mt-3"><span style="color: white;">Valider</span></button>
			</form></br></br>
		</div>
		<div style="padding-left: 200px;" class="col">
			<h4 style="color: #531B51;"><b>Ajouter un administrateur</b></h4>
			<form action="ajout_admin.php" method="POST">
				<div class="form-group mt-4">
					<label>Adresse email :</label>
					<input type="text" name="email" class="form-control" placeholder="Adresse email" required>
			    </div>
				<button style="background-color: #9D1458;" type="submit" class="btn btn-outline-light mt-3"><span style="color: white;">Valider</span></button>
			</form></br></br>
		</div>
	</div>
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
