<?php
	
	require "include/header.php";
	require "include/functions.php";
	require "bdd/database.php";

	logged_only();


	$nom = $_SESSION['auth']->nom;
	$prenom = $_SESSION['auth']->prenom;
	$email = $_SESSION['auth']->email;


	$resColla = RecuperationParCollaborateur();

	$resSiteMandat = RecuperationParSiteMandat();

	$resSiteVente = RecuperationParSiteVente();

	$resConsolidation = RecuperationParConsolidation();

	$resMandat = recuperationToutMandat();

	adminOnly($droit, $email);

?>

<style>

a:hover
{
	text-decoration: none;
}

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


center
{
	display: none;
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
		padding-left: 150px;
		width: 80%;
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
		padding-left: 250px;
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
		padding-left: 300px;
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
	
	<h3 style="color: #531B51;"><b>STATISTIQUE DE SALES CHALLENGE</b></h3>
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
		<div class="row">
			<div class="col">
				<form action="filtre_mois.php" method="POST">
					<div class="form-group">
						<select name="mois" style="width: 50%; background-color: #531B51; color: white;" class="form-control">
							<option id="periode" selected="selected"><span>Mois</span></option>
							<option id="01">Janvier</option>
							<option id="02">Février</option>
							<option id="03">Mars</option>
							<option id="04">Avril</option>
							<option id="05">Mai</option>
							<option id="06">Juin</option>
							<option id="07">Juillet</option>
							<option id="08">Août</option>
							<option id="09">Septembre</option>
							<option id="10">Octobre</option>
							<option id="11">Novembre</option>
							<option id="12">Décembre</option>
						</select>
					</div>
				</form>
			</div>
			<div class="col">
				<form action="filtre_trimestre.php" method="POST">
					<div class="form-group">
						<select name="trimestre" style="width: 50%; background-color: #531B51; color: white;" class="form-control">
							<option id="periode" selected="selected"><span>Trimestre</span></option>
							<option id="1">Trimestre 1</option>
							<option id="2">Trimestre 2</option>
							<option id="3">Trimestre 3</option>
							<option id="4">Trimestre 4</option>
						</select>
					</div>
				</form>
			</div>
			
		</div>
		<table id="filtre_mois" class="table table-striped">
	  		<thead>
			    <tr>
			    	<th style="text-align: center;" scope="col">Collaborateurs</th>
			    	<th style="text-align: center;" scope="col">Site de rattachement</th>
			      	<th style="text-align: center;" scope="col">Nombre de véhicules vendus</th>
			      	<th style="text-align: center;" scope="col">Nombre de livraison</th>
			      	<th style="text-align: center;" scope="col">Nombre de financement</th>
			      	<th style="text-align: center;" scope="col">Nombre de garantie</th>
			      	<th style="text-align: center;" scope="col">Nombre de frais de mise en route</th>
			    </tr>
	  		</thead>
		  	<tbody>
		  		<?php foreach($resColla as $result): ?>
		  			<?php 
		  				$total_vente += $result->vente;
		  				$total_livraison += $result->livree;
		  				$total_financement += $result->financement;
		  				$total_garantie += $result->garantie;
		  				$total_fme += $result->fme;
		  			?>
		  			<tr>
			  			<td align="center"><?= $result->prenom ?> <?= $result->nom ?></td>
			  			<td align="center"><?= $result->site_ratachement ?></td>
			  			<td align="center"><?= $result->vente ?></td>
			  			<td align="center"><?= $result->livree ?></td>
			  			<td align="center"><?= $result->financement ?></td>
			  			<td align="center"><?= $result->garantie ?></td>
			  			<td align="center"><?= $result->fme ?></td>
		  			</tr>
		  		<?php endforeach; ?>
		  		<tr>
		  			<td align="center"><b>TOTAL</b></td>
		  			<td align="center"></td>
		  			<td align="center"><b><?= $total_vente ?></b></td>
		  			<td align="center"><b><?= $total_livraison ?></b></td>
		  			<td align="center"><b><?= $total_financement ?></b></td>
		  			<td align="center"><b><?= $total_garantie ?></b></td>
		  			<td align="center"><b><?= $total_fme ?></b></td>
		  		</tr>
		  	</tbody>
		</table>
		<div style="text-align: right;">
			<a id="lien" href="export_csv_vente.php" style="text-align: right; color: black; font-size: 15px; text-decoration: none;"><i style="color: #207245;" class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp;&nbsp;Exporter au format CSV</a>
		</div>
		</br>
		</br>

		<table id="filtre_mois_mandat" class="table table-striped">
	  		<thead>
			    <tr>
			    	<th style="text-align: center;" scope="col">Collaborateurs</th>
			    	<th style="text-align: center;" scope="col">Site de rattachement</th>
			      	<th style="text-align: center;" scope="col">Nombre de mandats</th>
			    </tr>
	  		</thead>
		  	<tbody>
		  		<?php foreach($resMandat as $result): ?>
		  			<?php
		  				$total += $result->nombre;
		  			?>
		  			<tr>
			  			<td align="center"><?= $result->prenom ?> <?= $result->nom ?></td>
			  			<td align="center"><?= $result->site_ratachement ?></td>
			  			<td align="center"><?= $result->nombre ?></td>
		  			</tr>
		  		<?php endforeach; ?>
		  		<tr>
		  			<td align="center"><b>TOTAL</b></td>
		  			<td align="center"></td>
		  			<td align="center"><b><?= $total ?></b></td>
		  		</tr>
		  	</tbody>
		</table>
		<div style="text-align: right;">
			<a id="lien_mandat" href="export_csv_mandat.php" style="text-align: right; color: black; font-size: 15px; text-decoration: none;"><i style="color: #207245;" class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp;&nbsp;Exporter au format CSV</a>
		</div></br></br>
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
		<table style="margin-bottom: 50px;" class="table table-striped">
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
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {

		// Je sélectionne le select et quand la valeur change on fait une action
		$('select[name="filtre"]').change(function(){

		    // Je créer l'id du div qui va être affiché
		    var id = "ma_table_" + $(this).val();
		    console.log(id)
		    // Je cache toutes les divs grâce à une classe qui va sélectionner le tout
		    $('center').hide();

		    // Et j'affiche seulement le Div que je souhaite
		    $('#'+id).show();

		});

		$('select[name="mois"]').change(function(e){

			e.preventDefault();

			var mois = $("select[name='mois'] option:selected").attr("id");
			var url = 'export_csv_vente.php?mois='+mois;
			var lien_mandat = 'export_csv_mandat.php?mois='+mois;

			jQuery.ajax({
				url : 'filtre_mois.php',
				type : 'POST',
				data : {
					mois : mois
				},
				success: function(data)
				{
	 				$('#filtre_mois').html(data);
	 				$('#lien').attr('href',url);
	 				$('#lien_mandat').attr('href',lien_mandat);

				},
				error: function(jqxhr)
				{
					alert(jqxhr.responseText);
				}
			});

			jQuery.ajax({
				url : 'filtre_mois_mandat.php',
				type : 'POST',
				data : {
					mois : mois
				},
				success: function(data)
				{
	 				$('#filtre_mois_mandat').html(data);
				},
				error: function(jqxhr)
				{
					alert(jqxhr.responseText);
				}
			});

		})

		$('select[name="trimestre"]').change(function(e){

			e.preventDefault();

			var trimestre = $("select[name='trimestre'] option:selected").attr("id");
			var url = 'export_csv_vente_trimestre.php?trimestre='+trimestre;
			var lien_mandat = 'export_csv_mandat_trimestre.php?trimestre='+trimestre;

			jQuery.ajax({
				url : 'filtre_trimestre.php',
				type : 'POST',
				data : {
					trimestre : trimestre
				},
				success: function(data)
				{
	 				$('#filtre_mois').html(data);
	 				$('#lien').attr('href',url);
	 				$('#lien_mandat').attr('href',lien_mandat);
				},
				error: function(jqxhr)
				{
					alert(jqxhr.responseText);
				}
			});

			jQuery.ajax({
				url : 'filtre_trimestre_mandat.php',
				type : 'POST',
				data : {
					trimestre : trimestre
				},
				success: function(data)
				{
	 				$('#filtre_mois_mandat').html(data);
				},
				error: function(jqxhr)
				{
					alert(jqxhr.responseText);
				}
			});

		})
	});
</script>
<?php require "include/footer.php" ?>