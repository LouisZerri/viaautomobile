<?php

	require "bdd/database.php";
	require "include/functions.php";

	logged_only();
	$nom = $_SESSION['auth']->nom;

	if(isset($_GET['id']))
	{
		deleteVente($_GET['id']);
		header('Location: historique.php');
	}
?>