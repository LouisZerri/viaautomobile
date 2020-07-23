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
		if($_POST['trimestre'] == 'periode')
		{
			$donnees = RecuperationParCollaborateur();
		}
		else
		{
			$donnees = RecupParCollaborateurByTrim($_POST['trimestre']);
		}
		?>
		<?php if($donnees != null): ?>
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
			  		<?php foreach($donnees as $result): ?>
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