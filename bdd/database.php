<?php

	function debug($var)
	{
		echo '<pre>'.print_r($var,true).'</pre>';
	}
	
	function connexionBaseDeDonnee()
	{
		$pdo = new PDO('mysql:host=localhost;dbname=viaautomobile;charset=utf8', 'root', '');

		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

		return $pdo;
	}

	function connexionApplication($email)
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->prepare('SELECT * FROM vendeurs WHERE email = ?');

	    $req->execute([$email]);
	    $user = $req->fetch();

	    return $user;
	}

	function checkEmail($email)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('SELECT id_vendeurs FROM vendeurs WHERE email = ?');
		
		$query->execute([$email]);
		
		$mail = $query->fetch();

		if($mail != null)
		{
			return true;
		}

		return false;
	}

	function insertVendeur($nom, $prenom, $date, $site, $email, $password, $portable)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare("INSERT INTO vendeurs SET nom = ?, prenom = ?, date_naissance = ?, site_ratachement = ?, email = ?, mot_de_passe = ?, portable = ?");

		$query->execute([$nom, $prenom, $date, $site, $email, $password, $portable]);
	}

?>