<?php
	
	require "include/functions.php";
	require "bdd/database.php";

	logged_only();

	if(!empty($_POST))
	{
		$errors = array();

		if(is_numeric($_POST['titre']))
		{
			$errors['titre'] = "Le titre du challenge ne peut pas être une valeur numérique";
		}

		if(is_numeric($_POST['periode']))
		{
			$errors['periode'] = "La période du challenge ne peut pas être une valeur numérique";
		}

		if(isset($_FILES['file']) && $_FILES['file']['error'] == 0)
		{
			$infosfichier = pathinfo($_FILES['file']['name']);
			$name = $infosfichier['filename'];
			$extension_upload = strtolower($infosfichier['extension']);
			$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

			if(!in_array($extension_upload, $extensions_autorisees))
			{
				$errors['file'] = "L'extension du fichier est incorrecte";
			}
			else
			{
				$repertoireDestination = "/var/www/html/viaautomobile.pepperbay.fr/style";
				$nomDestination = "$name.$extension_upload";
				$file = "$repertoireDestination/$nomDestination";
				if(is_uploaded_file($_FILES["file"]["tmp_name"])) 
	    		{
		        	$resultat = move_uploaded_file($_FILES['file']['tmp_name'], $file);
		        }
		    }	
		}

		if(isset($_FILES['file_accueil']) && $_FILES['file_accueil']['error'] == 0)
		{
			$infosfichier = pathinfo($_FILES['file_accueil']['name']);
			$name = $infosfichier['filename'];
			$extension_upload = strtolower($infosfichier['extension']);
			$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

			if(!in_array($extension_upload, $extensions_autorisees))
			{
				$errors['file_accueil'] = "L'extension du fichier est incorrecte";
			}
			else
			{
				$repertoireDestination = "/var/www/html/viaautomobile.pepperbay.fr/style";
				$nomDestinationImage = "$name.$extension_upload";
				$file = "$repertoireDestination/$nomDestination";
				if(is_uploaded_file($_FILES["file_accueil"]["tmp_name"])) 
	    		{
		        	$resultat = move_uploaded_file($_FILES['file_accueil']['tmp_name'], $file);
		        }
		    }	
		}


		if(empty($errors) && $resultat)
		{

			insertChallenge($_POST['titre'],$_POST['periode'],$_POST['description'],$nomDestination, $nomDestinationImage);
			$_SESSION['flash']['success'] = 'Le challenge a été ajouté avec succès';
			header('Location: op_challenge.php');
		}
		else
		{
			$_SESSION['flash']['danger'] = 'Il y a des erreurs dans la création d\'un nouveau challenge';
			header('Location: op_challenge.php');
		}
	}
?>