<?php

	require "bdd/database.php";

	if(isset($_GET['id']))
	{
		deleteHistorique($_GET['id']);
		header('Location: historique.php');
	}
?>