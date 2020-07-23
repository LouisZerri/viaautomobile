<?php

	require "include/functions.php";

	logged_only();

	date_default_timezone_set('Europe/Paris');

	$nom = $_SESSION['auth']->nom;

	$is_livree = "";
	$is_frais_mer = "";
	$is_garentie = "";
	$is_financement = "";
	
	if(!empty($_POST))
	{
		require "bdd/database.php";

		
		$errors = array();

		if(empty($_POST['date_vente']))
		{
			$errors['date'] = "Vous n'avez pas inséré de date de vente";
		}

		if(empty($_POST['immatriculation']))
		{
			$errors['immatriculation'] = "Vous n'avez pas inséré l'immatriculation du véhicule";
		}

		$immatriculation = immatriculationExist($_POST['immatriculation']);
		
		if($immatriculation)
		{
			$errors['immatriculation_exist'] = "Vous ne pouvez pas saisir l'immatriculation d'un véhicule déjà existant";
		}

		$caractere = isCaractere($_POST['immatriculation']);

		if($caractere == false)
		{
			$errors['caractere'] = "L'immatriculation du vehicule ne doit contenir ni espace, ni caractere spéciaux";
		}

		if(!empty($_POST['livree']))
		{
			foreach($_POST['livree'] as $livree)
			{ 
				$is_livree = $livree;
			}
		}
		else
		{
			$errors['livree'] = "Erreur livrée";
		}

		if(!empty($_POST['frais_mer']))
		{
			foreach($_POST['frais_mer'] as $frais_mer)
			{ 
				$is_frais_mer = $frais_mer;
			}
		}
		else
		{
			$errors['fmer'] = "Erreur frais mise en route";
		}

		if(!empty($_POST['garentie']))
		{
			foreach($_POST['garentie'] as $garentie)
			{ 
				$is_garentie = $garentie;
			}
		}
		else
		{
			$errors['garantie'] = "Erreur garantie";
		}

		if(!empty($_POST['financement']))
		{
			foreach($_POST['financement'] as $financement)
			{ 
				$is_financement = $financement;
			}
		}
		else
		{
			$errors['financement'] = "Erreur financement";
		}

		if(empty($errors))
		{
			insertVente($nom, $_POST['date_vente'], $_POST['immatriculation'], $is_livree, $is_frais_mer, $is_garentie, $is_financement, date('d/m/Y'));
    		header('Location: tableau_de_bord.php');
		}
		else
		{
			foreach ($errors as $key => $value) 
			{
				if($key == "immatriculation_exist")
				{
					$_SESSION['flash']['danger'] = $value;
					header('Location: tableau_de_bord.php');
					exit();
				}

				if($key == "caractere")
				{
					$_SESSION['flash']['danger'] = $value;
					header('Location: tableau_de_bord.php');
					exit();
				}
			}

			$_SESSION['flash']['danger'] = 'Tous les champs ne sont pas remplis';
			header('Location: tableau_de_bord.php');
		}

	}

	
?>

