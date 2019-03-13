<?php
	
	require "include/header.php";
	require "include/functions.php";
	require "bdd/database.php";

	logged_only();

	$nom = $_SESSION['auth']->nom;
	$prenom = $_SESSION['auth']->prenom;

	$resColla = RecuperationParCollaborateur();

	$resSiteMandat = RecuperationParSiteMandat();

	$resSiteVente = RecuperationParSiteVente();

	$resConsolidation = RecuperationParConsolidation();

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

}

.separation
{
	
	position: absolute;
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
	position:relative;
	z-index:10;
}

span
{
	color: white;
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
	position:relative;
	z-index:10;
}

center 
{
	display: none;
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
		position: absolute; 
		bottom:0; 
		left:0;
		top: 0;
		right:0;  
		margin: auto;
		margin-left: 300px;
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
		padding-top: 50px;
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
	<img style="position: absolute; left: 0; bottom: 0; padding-left: 15px;" src="style/logo_gris.svg" alt="logo" width="230">
</div>

<div class="container">
	<h3><b>STATISTIQUE DE SALES CHALLENGE</b></h3>
	<form action="" method="POST">
		<div class="form-group mt-5">
			<p>Filtrer les recherches par :</p>
			<select class="form-control" name="filtre">
				<option selected="selected">Filtre</option>
				<option>Collaborateurs</option>
				<option>Sites</option>
				<option>Consolidations</option>
			</select>
	    </div>
	</form>
</div>
<div style="margin-top: 50px;" class="container">
	<center id="ma_table_Collaborateurs">
		<table class="table table-striped">
	  		<thead>
			    <tr>
			    	<th style="text-align: center;" scope="col">Collaborateurs</th>
			    	<th style="text-align: center;" scope="col">Site de rattachement</th>
			      	<th style="text-align: center;" scope="col">Nombre de mandats</th>
			      	<th style="text-align: center;" scope="col">Nombre de véhicules vendus</th>
			    </tr>
	  		</thead>
		  	<tbody>
		  		<?php foreach($resColla as $result): ?>
		  			<tr>
			  			<td align="center"><?= $result->prenom ?> <?= $result->nom ?></td>
			  			<td align="center"><?= $result->site_ratachement ?></td>
			  			<td align="center"><?= $result->nombre ?></td>
			  			<td align="center"><?= $result->vente ?></td>
		  			</tr>
		  		<?php endforeach; ?>
		  	</tbody>
		</table>
	</center>
	<center id="ma_table_Sites">
		<div class="row">
			<div class="col">
				<table  class="table table-striped">
			  		<thead>
					    <tr>
					    	<th style="text-align: center;" scope="col">Site de rattachement</th>
					      	<th style="text-align: center;" scope="col">Nombre de mandats</th>
					    </tr>
			  		</thead>
				  	<tbody>
				  		<?php foreach($resSiteMandat as $result): ?>
				  			<tr>
					  			<td align="center"><?= $result->site_ratachement ?></td>
					  			<td align="center"><?= $result->mandat ?></td>
				  			</tr>
				  		<?php endforeach; ?>
				  	</tbody>
				</table>
			</div>
			<div class="col">
				<table id="ma_table_Sites" class="table table-striped">
			  		<thead>
					    <tr>
					    	<th style="text-align: center;" scope="col">Site de rattachement</th>
					      	<th style="text-align: center;" scope="col">Nombre de vente</th>
					    </tr>
			  		</thead>
				  	<tbody>
				  		<?php foreach($resSiteVente as $result): ?>
				  			<tr>
					  			<td align="center"><?= $result->site_ratachement ?></td>
					  			<td align="center"><?= $result->vente ?></td>
				  			</tr>
				  		<?php endforeach; ?>
				  	</tbody>
				</table>
			</div>
		</div>
	</center>
	<center id="ma_table_Consolidations">
		<table class="table table-striped">
	  		<thead>
			    <tr>
			    	<th style="text-align: center;" scope="col">Collaborateurs</th>
			    	<th style="text-align: center;" scope="col">Email </th>
			      	<th style="text-align: center;" scope="col">Nombre de mandats</th>
			      	<th style="text-align: center;" scope="col">Nombre de véhicules vendus</th>
			    </tr>
	  		</thead>
		  	<tbody>
		  		<?php foreach($resConsolidation as $result): ?>
		  			<tr>
			  			<td align="center"><?= $result->prenom ?> <?= $result->nom ?></td>
			  			<td align="center"><?= $result->email ?></td>
			  			<td align="center"><?= $result->mandat ?></td>
			  			<td align="center"><?= $result->vente ?></td>
		  			</tr>
		  		<?php endforeach; ?>
		  	</tbody>
		</table>
	</center>
</div>




<script type="text/javascript">
	
	$(document).ready(function() {
		// Je sélectionne le select et quand la valeur change on fait une action
		$('select[name="filtre"]').change(function(){
		    // Je créer l'id du div qui va être affiché
		    var id = "ma_table_" + $(this).val();
		    // Je cache toutes les divs grâce à une classe qui va sélectionner le tout
		    $('center').hide(1000);

		    // Et j'affiche seulement le Div que je souhaite
		    $('#'+id).show(1000);

		});
	});
</script>
<?php require "include/footer.php" ?>