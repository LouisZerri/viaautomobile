<?php
	
	function erreurs()
	{
		error_reporting(E_ALL);
		ini_set('display_errors', 'On');
		ini_set('log_errors', 'On');
	}
	
	function formatDate($date)
	{
		$string = explode("/",$date);

		$newdate = implode($string);

		if(strlen($newdate) == 8 && is_numeric($newdate))
		{
			return true;
		}
		
		return false;
	}

	function formatTelephone($telephone)
	{
		$result = "+ 33";
		$telephone = str_replace(" ", "", $telephone);
		$string = substr($telephone, 1);
		return $result."".$string;
	}

	function sendEmailForConfirmation($mail, $last_id, $token)
	{
		if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
		{
			$passage_ligne = "\r\n";
		}
		else
		{
			$passage_ligne = "\n";
		}
		//=====Déclaration des messages au format texte et au format HTML.
		$message_txt = "Afin de valider votre compte, merci de cliquer sur ce lien\n\nhttp://viaautomobile.pepperbay.fr/confirmation.php?id=".$last_id."&token=".$token;
		$message_html = "<p>Afin de valider votre compte, merci de cliquer sur ce lien : </br> http://viaautomobile.pepperbay.fr/confirmation.php?id=".$last_id."&token=".$token."</p>";
		
		//==========
		
		//=====Création de la boundary
		$boundary = "-----=".md5(rand());
		//==========
		
		//=====Définition du sujet.
		$sujet = "Confirmation de votre compte";
		//=========
		
		//=====Création du header de l'e-mail.
		$header = "From: \"Via Automobile\"<contact@viaautomobile.fr>".$passage_ligne;
		$header.= "Reply-to: \"Via Automobile\" <contact@viaautomobile.fr>".$passage_ligne;
		$header.= "MIME-Version: 1.0".$passage_ligne;
		$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
		//==========
		
		//=====Création du message.
		$message = $passage_ligne."--".$boundary.$passage_ligne;
		//=====Ajout du message au format texte.
		$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_txt.$passage_ligne;
		//==========
		$message.= $passage_ligne."--".$boundary.$passage_ligne;
		//=====Ajout du message au format HTML
		$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_html.$passage_ligne;
		//==========
		$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
		$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
		//==========
		
		//=====Envoi de l'e-mail.
		mail($mail,$sujet,$message,$header);
		//==========

	}

	function sendEmailForReset($mail, $user_id, $reset_token)
	{
		if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
		{
			$passage_ligne = "\r\n";
		}
		else
		{
			$passage_ligne = "\n";
		}
		//=====Déclaration des messages au format texte et au format HTML.
		$message_txt = "Afin de réinitialiser votre mot de passe, merci de cliquer sur ce lien\n\nhttp://viaautomobile.pepperbay.fr/reset.php?id=".$user_id."&token=".$reset_token;
		$message_html = "<p>Afin de réinitialiser votre mot de passe, merci de cliquer sur ce lien : </br> http://viaautomobile.pepperbay.fr/reset.php?id=".$user_id."&token=".$reset_token."</p>";
		
		//==========
		
		//=====Création de la boundary
		$boundary = "-----=".md5(rand());
		//==========
		
		//=====Définition du sujet.
		$sujet = "Réinitialisation de votre mot de passe";
		//=========
		
		//=====Création du header de l'e-mail.
		$header = "From: \"Via Automobile\"<contact@viaautomobile.fr>".$passage_ligne;
		$header.= "Reply-to: \"Via Automobile\" <contact@viaautomobile.fr>".$passage_ligne;
		$header.= "MIME-Version: 1.0".$passage_ligne;
		$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
		//==========
		
		//=====Création du message.
		$message = $passage_ligne."--".$boundary.$passage_ligne;
		//=====Ajout du message au format texte.
		$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_txt.$passage_ligne;
		//==========
		$message.= $passage_ligne."--".$boundary.$passage_ligne;
		//=====Ajout du message au format HTML
		$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_html.$passage_ligne;
		//==========
		$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
		$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
		//==========
		
		//=====Envoi de l'e-mail.
		mail($mail,$sujet,$message,$header);
		//==========

	}

	function str_random($length)
	{
		$alphabet = "abcdefghijklmnopqrstuvwxyz012345689";
		return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
	}

	function logged_only()
	{
		if(session_status() == PHP_SESSION_NONE)
		{
			session_start();
		}
		if(!isset($_SESSION['auth']))
		{
			$_SESSION['flash']['danger'] = "Veuillez vous connectez pour accéder à cette page";
			header('Location: login.php');
			exit();
		}
	}

	function week2str($annee, $no_semaine)
	{
    	// Récup jour début et fin de la semaine
	    $timeStart = strtotime("First Monday January {$annee} + ".($no_semaine - 1)." Week");
	    $timeEnd   = strtotime("First Monday January {$annee} + {$no_semaine} Week -1 day");
	     
	    // Récup année et mois début
	    $anneeStart = date("Y", $timeStart);
	    $anneeEnd   = date("Y", $timeEnd);
	    $moisStart  = date("m", $timeStart);
	    $moisEnd    = date("m", $timeEnd);
	     
	    // Gestion des différents cas de figure
	    if( $anneeStart != $anneeEnd ){
	        // à cheval entre 2 années
	        $retour = "Semaine du ".strftime("%d %B %Y", $timeStart)." au ".strftime("%d %B %Y", $timeEnd);
	    } elseif( $moisStart != $moisEnd ){
	        // à cheval entre 2 mois
	        $retour = "Semaine du ".strftime("%d %B", $timeStart)." au ".strftime("%d %B %Y", $timeEnd);
	    } else {
	        // même mois
	        $retour = "Semaine du ".strftime("%d", $timeStart)." au ".strftime("%d %B %Y", $timeEnd);
	    }

	    return $retour;
	}

?>




