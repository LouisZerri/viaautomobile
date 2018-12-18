<?php

	require "include/functions.php";

	logged_only();

	date_default_timezone_set('Europe/Paris');

	$nom = $_SESSION['auth']->nom;

	require "bdd/database.php";

	$is_livree = "";
	$is_frais_mer = "";
	$is_garentie = "";
	$is_financement = "";

	foreach($_POST['livree'] as $livree)
	{ 
   		$is_livree = $livree;
	}

	foreach($_POST['frais_mer'] as $frais_mer)
	{ 
   		$is_frais_mer = $frais_mer;
	}

	foreach($_POST['garentie'] as $garentie)
	{ 
   		$is_garentie = $garentie;
	}

	foreach($_POST['financement'] as $financement)
	{ 
   		$is_financement = $financement;
	}

	insertVente($nom, $_POST['date_vente'], $_POST['immatriculation'], $is_livree, $is_frais_mer, $is_garentie, $is_financement, date('d/m/Y'));
    header('Location: tableau_de_bord.php');
?>

