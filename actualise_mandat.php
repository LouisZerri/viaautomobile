<?php

	require "bdd/database.php";
	require "include/functions.php";

	logged_only();

	$nom = $_SESSION['auth']->nom;

	if(empty($_POST['nombre']) || !is_numeric($_POST['nombre']))
	{
		header('Location: tableau_de_bord.php');
	}
	else
	{
		$current_mandat = recupereMandat($nom);

		$current_mandat->nombre += $_POST['nombre'];

		updateMandat($current_mandat->nombre, $nom);

	    header('Location: tableau_de_bord.php');
	}

?>