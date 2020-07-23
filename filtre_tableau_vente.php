<?php

	require "bdd/database.php";
	require "include/functions.php";

	$delete_vente = "delete_vente.php?id=";

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
			$donnees = getAllVente($nom);
		}
		else
		{
			$donnees = recupereMoisFromVente($_POST['mois'], $nom);
		}
		?>
		<?php if($donnees != null): ?>
			<table id="ma_table_Ventes" class="table table-striped ml-5 mt-5">
			<thead>
				<tr>
	  				<th scope="col">Date de vente</th>
			      	<th scope="col">Immatriculation</th>
			      	<th scope="col">Livraisons</th>
			      	<th scope="col">FMS</th>
			      	<th scope="col">Garanties</th>
			      	<th scope="col">Financements</th>
			      	<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1 ?>
				<?php foreach($donnees as $res): ?>
					<tr id="tableau">
						<td align="center" id="date_vente"><?= $res->date_vente; ?></td>
						<td align="center"><?= $res->immatriculation; ?></td>
						<?php if($res->livree == 1): ?>
							<td align="center" style="font-weight: bold; color: #531B51;">Oui</td>
						<?php else: ?>
							<td align="center">Non</td>
						<?php endif; ?>
						<?php if($res->frais_mer == 1): ?>
							<td align="center" style="font-weight: bold; color: #531B51;">Oui</td>
						<?php else: ?>
							<td align="center">Non</td>
						<?php endif; ?>
						<?php if($res->garentie == 1): ?>
							<td align="center" style="font-weight: bold; color: #531B51;">Oui</td>
						<?php else: ?>
							<td align="center" >Non</td>
						<?php endif; ?>
						<?php if($res->financement == 1): ?>
							<td align="center" style="font-weight: bold; color: #531B51;">Oui</td>
						<?php else: ?>
							<td align="center">Non</td>
						<?php endif; ?>
						<?php if(date("m") != substr($res->date_vente,3,2)): ?>
							<td align="center"><a style="color: black;" ><i class="fa fa-times"></i></a></td>
						<?php else: ?>
							<td align="center"><a id="vente" style="color: black;" href="<?= $delete_vente."".$res->id_vente ?>"><i class="fa fa-trash"></i></a></td>
						<?php endif; ?>
					</tr>
					<?php $i++; ?>
				<?php endforeach; ?>
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