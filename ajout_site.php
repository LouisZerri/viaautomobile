<?php
	
	require "include/functions.php";
	require "bdd/database.php";

	logged_only();

	if(!empty($_POST))
	{
		$errors = array();

		if(empty($_POST['site']) || is_numeric($_POST['site']))
		{
			$errors['site'] = "Erreur de saisie dans l'ajout d'un site de rattachement";
		}

		if(empty($errors))
		{

			insertSiteDeRattachement($_POST['site']);
			$_SESSION['flash']['success'] = 'Le site de rattachement a été ajouté avec succès';
			header('Location: backoffice.php');
		}
		else
		{
			$_SESSION['flash']['danger'] = 'Il y a des erreurs dans l\'ajout d\'un site de rattachement';
			header('Location: op_challenge.php');
		}

	}