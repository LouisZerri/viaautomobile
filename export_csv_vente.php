<?php

	header("content-type:application/csv;charset=UTF-8");
	header('Content-Type: text/csv;');
	header('Content-Disposition: attachment; filename="export_vente.csv"');

	require "bdd/database.php";

	if(isset($_GET['mois']))
	{
		$resColla = RecupParCollaborateurByMonth($_GET['mois']);
	}
	else
	{
		$resColla = RecuperationParCollaborateur();
	}


?>"Collaborateurs";"Site de rattachement";"Nombre de vehicule vendus";"Nombre de livraison";"Nombre de financement";"Nombre de garantie";"Nombre de frais de mise en route"<?php
	
	foreach ($resColla as $donnees) 
	{
		$total_vente += $donnees->vente;
		$total_livraison += $donnees->livree;
		$total_financement += $donnees->financement;
		$total_garantie += $donnees->garantie;
		$total_fme += $donnees->fme;

		echo "\n".'"'.utf8_decode($donnees->prenom) .' '. utf8_decode($donnees->nom).'";"'.utf8_decode($donnees->site_ratachement).'";"'.utf8_decode($donnees->vente).'";"'.utf8_decode($donnees->livree).'";"'.utf8_decode($donnees->financement).'";"'.utf8_decode($donnees->garantie).'";"'.utf8_decode($donnees->fme).'"';
	}
	echo "\n".'"TOTAL'.'"; ;"'.$total_vente.'";"'.$total_livraison.'";"'.$total_financement.'";"'.$total_garantie.'";"'.$total_fme.'"';

?>

