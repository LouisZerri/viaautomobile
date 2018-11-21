<?php
	
	session_start();
	require "bdd/database.php";

	$nom = $_SESSION['auth']->nom;

	if(empty($_POST['nombre']) || !is_numeric($_POST['nombre']))
	{
		header('Location: tableau_de_bord.php');
	}
	else
	{
		updateMandat($_POST['nombre'], $nom);
	    header('Location: tableau_de_bord.php');
	}

?>