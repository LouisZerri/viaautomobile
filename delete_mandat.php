<?php

	require "bdd/database.php";
	require "include/functions.php";

	logged_only();
	$nom = $_SESSION['auth']->nom;


	$res = recupNombre($_GET['id']);
	$current_mandat = recupereMandat($nom);
	$result = $current_mandat->nombre - $res->nombre;

	if(isset($_GET['id']))
	{
		deleteHistoriqueMandat($_GET['id']);
		updateMandat($result, $nom);
		header('Location: historique.php');
	}
?>