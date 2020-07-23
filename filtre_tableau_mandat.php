<?php

	require "bdd/database.php";
	require "include/functions.php";

	$delete_mandat = "delete_mandat.php?id=";

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
			$donnees = recupHistorique($nom);
		}
		else
		{
			$donnees = recupereMoisFromMandat($_POST['mois'], $nom);
		}
		?>
		<?php if($donnees != null): ?>
			<table id="ma_table_Mandats" class="table table-striped ml-5 mt-5">
				<thead>
					<tr>
		  				<th align="center" scope="col">Date</th>
				      	<th align="center" scope="col">Nombre de mandats</th>
				      	<th align="center" scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($donnees as $res): ?>
						<tr align="center" id="<?= $i; ?>">
							<td align="center" id="date_mandat"><?= $res->date_mandat; ?></td>
							<td align="center"><?= $res->nombre; ?></td>
							<?php if(date("m") != substr($res->date_vente,3,2)): ?>
								<td align="center"><a style="color: black;"><i class="fa fa-times"></i></a></td>
							<?php else: ?>
								<td align="center"><a id="mandat" style="color: black;" href="<?= $delete_mandat."".$res->id_historique ?>"><i class="fa fa-trash"></i></a></td>
							<?php endif; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php else: ?>
			<div class="container">
				<div style="font-size: 15px; margin-right: 200px;" class="alert alert-warning" role="alert">
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