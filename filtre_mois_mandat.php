<?php

	require "bdd/database.php";
	require "include/functions.php";

	logged_only();

	function isAjax()
	{
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
	}

	$nom = $_SESSION['auth']->nom;

	if(isAjax())
	{
		if($_POST['mois'] == "periode")
		{
			$donnees = RecuperationParCollaborateur();
		}
		else
		{
			$donnees = RecuperationMoisMandat($_POST['mois']);
		}
		?>
		<?php if($donnees != null): ?>
			<table id="filtre_mois_mandat" class="table table-striped">
		  		<thead>
				    <tr>
				    	<th style="text-align: center;" scope="col">Collaborateurs</th>
				    	<th style="text-align: center;" scope="col">Site de rattachement</th>
				      	<th style="text-align: center;" scope="col">Nombre de mandats</th>
				    </tr>
		  		</thead>
			  	<tbody>
			  		<?php foreach($donnees as $result): ?>
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
		<?php else: ?>
			<div class="container">
				<div style="font-size: 15px; width: 725px;" class="alert alert-warning" role="alert">
	  				<i class="fa fa-warning"></i>&nbsp;&nbsp;Aucune donnée à afficher
				</div>
			</div>
		<?php endif; ?>
		<?php
	}
	else
	{
		header('Location: tableau_de_bord.php');
	}



?>