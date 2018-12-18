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

	function vendeurExiste($email)
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->prepare('SELECT * FROM vendeur WHERE email = ? AND confirmed_at IS NOT NULL');

		$req->execute([$email]);

		$vendeur = $req->fetch();

		return $vendeur;
	}

	function resetToken($token, $id)
	{	
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->prepare('UPDATE vendeur SET reset_token = ?, reset_at = NOW() WHERE id_vendeur = ?');

		$req->execute([$token, $id]);
	}

	function checkEmail($email)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('SELECT id_vendeur FROM vendeur WHERE email = ?');
		
		$query->execute([$email]);
		
		$mail = $query->fetch();

		if($mail != null)
		{
			return true;
		}

		return false;
	}

	function insertVendeur($nom, $prenom, $date, $site, $email, $password, $portable, $confirmation)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare("INSERT INTO vendeur SET nom = ?, prenom = ?, date_naissance = ?, site_ratachement = ?, email = ?, mot_de_passe = ?, portable = ?, confirmation_cle = ?");

		$password = password_hash($password, PASSWORD_BCRYPT);

		$query->execute([$nom, $prenom, $date, $site, $email, $password, $portable, $confirmation]);

		$marequete = $pdo->prepare("SELECT id_vendeur FROM vendeur WHERE nom = ?");

		$marequete->execute([$nom]);

		$res = $marequete->fetch();

		$query2 = $pdo->prepare("INSERT INTO mandat SET id_vendeur = ?, nombre = 0");

		$query2->execute([$res->id_vendeur]);
	}

	function recupereMandat($nom_vendeur)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare("SELECT nombre FROM mandat INNER JOIN vendeur on vendeur.id_vendeur = mandat.id_vendeur WHERE nom = ?");
		
		$query->execute([$nom_vendeur]);

		$res = $query->fetch();

		return $res;

	}

	function updateMandat($nombre, $nom)
	{
		$pdo = connexionBaseDeDonnee();

		$marequete = $pdo->prepare("SELECT id_vendeur FROM vendeur WHERE nom = ?");

		$marequete->execute([$nom]);

		$res = $marequete->fetch();

		$query = $pdo->prepare("UPDATE mandat SET nombre = ? WHERE id_vendeur = ?");
		
		$query->execute([$nombre, $res->id_vendeur]);
	}

	function insertVente($nom, $date_vente, $immatriculation, $livree, $frais_mer, $garentie, $financement, $datetime)
	{
		$pdo = connexionBaseDeDonnee();

		$marequete = $pdo->prepare("SELECT id_vendeur FROM vendeur WHERE nom = ?");

		$marequete->execute([$nom]);

		$res = $marequete->fetch();

		if($livree == 'Oui')
		{
			$livree = 1;
		}
		if($livree == 'Non')
		{
			$livree = 0;
		}

		if($frais_mer == 'Oui')
		{
			$frais_mer = 1;
		}
		if($frais_mer == 'Non')
		{
			$frais_mer = 0;
		}

		if($garentie == 'Oui')
		{
			$garentie = 1;
		}
		if($garentie == 'Non')
		{
			$garentie = 0;
		}

		if($financement == 'Oui')
		{
			$financement = 1;
		}
		if($financement == 'Non')
		{
			$financement = 0;
		}

		$query = $pdo->prepare("INSERT INTO vente SET id_vendeur = ?, date_vente = ?, immatriculation = ?, livree = ?, frais_mer = ?, garentie = ?, financement = ?, date_time = ?");

		$query->execute([$res->id_vendeur, $date_vente, $immatriculation, $livree, $frais_mer, $garentie, $financement, $datetime]);
	}

	function countVente($nom)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('SELECT count(id_vente) as vente FROM vente WHERE id_vendeur = (SELECT id_vendeur FROM vendeur WHERE nom = ?)');
		
		$query->execute([$nom]);
		
		$vente = $query->fetch();

		if($vente == null)
		{
			return 0;
		}

		return $vente->vente;
	}

	function countLivree($nom)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('SELECT count(id_vente) as livree from vente where id_vendeur = (SELECT id_vendeur FROM vendeur WHERE nom = ?) AND livree = 1');
		
		$query->execute([$nom]);
		
		$livree = $query->fetch();

		return $livree->livree;
	}

	function countFraisMER($nom)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('SELECT count(id_vente) as frais_mer from vente where id_vendeur = (SELECT id_vendeur FROM vendeur WHERE nom = ?) AND frais_mer = 1');
		
		$query->execute([$nom]);
		
		$frais_mer = $query->fetch();

		return $frais_mer->frais_mer;
	}

	function countGarentie($nom)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('SELECT count(id_vente) as garentie from vente where id_vendeur = (SELECT id_vendeur FROM vendeur WHERE nom = ?) AND garentie = 1');
		
		$query->execute([$nom]);
		
		$garentie = $query->fetch();

		return $garentie->garentie;
	}

	function countFinancement($nom)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('SELECT count(id_vente) as financement from vente where id_vendeur = (SELECT id_vendeur FROM vendeur WHERE nom = ?) AND financement = 1');
		
		$query->execute([$nom]);
		
		$financement = $query->fetch();

		return $financement->financement;
	}

	function getAllVente($nom)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('SELECT * FROM vente WHERE id_vendeur = (SELECT id_vendeur FROM vendeur WHERE nom = ?)');

		$query->execute([$nom]);

		$donnees = $query->fetchAll();

		return $donnees;
	}

	function deleteHistorique($id)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('DELETE FROM vente WHERE id_vente = ?');

		$query->execute([$id]);
	}

	function recupererDernierID()
	{
		$pdo = connexionBaseDeDonnee();
		
		$query = $pdo->query('SELECT MAX(id_vendeur) as last_id FROM vendeur');

		$query->execute();

		$res = $query->fetch();

		return $res;
	}

	function recupereUtilisateur($id)
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->prepare('SELECT * FROM vendeur WHERE id_vendeur = ?'); 
		
		$req->execute([$id]);
		
		$user = $req->fetch();
		
		return $user;
	}

	function updateUtilisateur($id)
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->prepare('UPDATE vendeur SET confirmation_cle = NULL, confirmed_at = NOW() WHERE id_vendeur = ?');
		
		$req->execute([$id]);
	}

	function selectInfoVendeur($id, $token)
	{
		$pdo = connexionBaseDeDonnee();

        $req = $pdo->prepare('SELECT * FROM vendeur WHERE id_vendeur = ? 
							 AND reset_token IS NOT NULL
							 AND reset_token = ?
							 AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
		
		$req->execute([$id, $token]);

		$vendeur = $req->fetch();

		return $vendeur;
	}

	function updatePassword($password)
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->prepare('UPDATE vendeur SET mot_de_passe = ?, reset_at = NULL, reset_token = NULL');

		$req->execute([$password]);
	}


	//Fonctions qui correspond au back-office

	function recupereSemaine()
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->query('SELECT * FROM semaine');

		$query->execute();

		$res = $query->fetch();

		return $res;
	}

	function updateSemaine($date_debut, $date_fin, $mois)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('UPDATE semaine SET debut_semaine = ?, fin_semaine = ?, mois = ?');

		$query->execute([$date_debut, $date_fin, $mois]);
	}

	function updateCompteur($compteur)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('UPDATE mandat SET nombre = ?');

		$query->execute([$compteur]);
	}

?>