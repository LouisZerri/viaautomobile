<?php
	
	require "include/header.php";
	require "include/functions.php";
	require "bdd/database.php";

	logged_only();

	$resColla = RecuperationParCollaborateur();

	$resSiteMandat = RecuperationParSiteMandat();

	$resSiteVente = RecuperationParSiteVente();

	$resConsolidation = RecuperationParConsolidation();

?>
<style>

center 
{
	display: none;
}
</style>

<div class="container" style="margin-top: 100px;">
	<h1>Partie Backoffice</h1>
	<form action="" method="POST">
		<div class="form-group">
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
			    	<th style="text-align: center;" scope="col">Site de ratachement</th>
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
					    	<th style="text-align: center;" scope="col">Site de ratachement</th>
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
					    	<th style="text-align: center;" scope="col">Site de ratachement</th>
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