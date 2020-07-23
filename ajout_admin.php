<?php

	require "include/functions.php";
	require "bdd/database.php";

	logged_only();

	if(!empty($_POST))
	{
		$errors = array();

		if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			$errors['email'] = "Votre email n'est pas valide";
		}
		else
		{
			
			if(checkEmailAdmin($_POST['email']))
			{
				$errors['email'] = "Cet email a déjà été ajouté en tant qu'administrateur";
			}
		}

		if(empty($errors))
		{

			insertAdmin($_POST['email']);
			$_SESSION['flash']['success'] = 'Le compte est passé au statut administrateur';
			header('Location: backoffice.php');
		}
		else
		{
			$_SESSION['flash']['danger'] = 'Il y a des erreurs dans l\'ajout d\'un compte au statut administrateur';
			header('Location: op_challenge.php');
		}

	}

?>