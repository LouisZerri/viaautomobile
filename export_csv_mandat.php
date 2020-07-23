<?php

	header("content-type:application/csv;charset=UTF-8");
	header('Content-Type: text/csv;');
	header('Content-Disposition: attachment; filename="export_mandat.csv"');

	require "bdd/database.php";

	if(isset($_GET['mois']))
	{
		$resSiteMandat = RecuperationMoisMandat($_GET['mois']);
	}
	else
	{
		$resSiteMandat = RecuperationToutMandat();
	}


?>"Collaborateurs";"Site de rattachement";"Nombre de mandats"<?php
	
	foreach ($resSiteMandat as $donnees) 
	{

		$total += $donnees->nombre;

		echo "\n".'"'.utf8_decode($donnees->prenom) .' '. utf8_decode($donnees->nom).'";"'.utf8_decode($donnees->site_ratachement).'";"'.utf8_decode($donnees->nombre).'"';
	}
	echo "\n".'"TOTAL'.'"; ;"'.$total.'"';

?>