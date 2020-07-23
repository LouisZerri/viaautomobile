<?php

	function debug($var)
	{
		echo '<pre>'.print_r($var,true).'</pre>';
	}
	
	function connexionBaseDeDonnee()
	{
		//$pdo = new PDO('mysql:host=localhost;dbname=viaautomobile;charset=utf8', 'root', '');
		$pdo = new PDO('mysql:host=localhost;dbname=viaautomobile;charset=utf8', 'root', 'iE7ZOy5dsql');
		
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

	function insertVendeur($nom, $prenom, $date, $site, $enseigne, $email, $password, $portable, $confirmation)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare("INSERT INTO vendeur SET nom = ?, prenom = ?, date_naissance = ?, site_ratachement = ?, enseigne = ? , email = ?, mot_de_passe = ?, portable = ?, confirmation_cle = ?");

		$password = password_hash($password, PASSWORD_BCRYPT);

		$query->execute([$nom, $prenom, $date, $site, $enseigne, $email, $password, $portable, $confirmation]);

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

	function insertHistorique($nombre, $nom, $date)
	{
		$pdo = connexionBaseDeDonnee();

		$marequete = $pdo->prepare("SELECT id_vendeur FROM vendeur WHERE nom = ?");

		$marequete->execute([$nom]);

		$res = $marequete->fetch();

		$query2 = $pdo->prepare("INSERT INTO historique SET id_vendeur = ?, nombre = ?, date_mandat = ?");

		$query2->execute([$res->id_vendeur, $nombre, $date]);
	}

	function recupHistorique($nom)
	{
		$pdo = connexionBaseDeDonnee();

		$marequete = $pdo->prepare("SELECT id_vendeur FROM vendeur WHERE nom = ?");

		$marequete->execute([$nom]);

		$res = $marequete->fetch();

		$query2 = $pdo->prepare("SELECT * FROM historique WHERE id_vendeur = ?");

		$query2->execute([$res->id_vendeur]);

		$res = $query2->fetchAll();

		return $res;
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



		$query2 = $pdo->prepare("INSERT INTO historique_vente SET id_vendeur = ?, date_vente = ?, immatriculation = ?, livree = ?, frais_mer = ?, garentie = ?, financement = ?, date_time = ?");

		$query2->execute([$res->id_vendeur, $date_vente, $immatriculation, $livree, $frais_mer, $garentie, $financement, $datetime]);
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

	function deleteVente($id)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('DELETE FROM vente WHERE id_vente = ?');

		$query->execute([$id]);
	}

	function deleteHistoriqueMandat($id)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('DELETE FROM historique WHERE id_historique = ?');

		$query->execute([$id]);
	}

	function recupNombre($id)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('SELECT nombre FROM historique WHERE id_historique = ?');

		$query->execute([$id]);

		$res = $query->fetch();

		return $res;
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

	function updatePassword($password, $id_vendeur)
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->prepare('UPDATE vendeur SET mot_de_passe = ?, reset_at = NULL, reset_token = NULL WHERE id_vendeur = ?');

		$req->execute([$password, $id_vendeur]);
	}

	function immatriculationExist($immatriculation)
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->prepare('SELECT * FROM vente WHERE immatriculation = ?');

		$req->execute([$immatriculation]);

		$immatriculation = $req->fetch();

		if($immatriculation != null)
		{
			return true;
		}

		return false;
	}

	function recupInfoVendeur($nom)
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->prepare('SELECT * FROM vendeur WHERE nom = ?');

		$req->execute([$nom]);

		$info = $req->fetch();

		return $info;
	}

	function updateVendeur($nom, $prenom, $naissance, $site, $enseigne, $email, $password, $telephone)
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->prepare('SELECT id_vendeur FROM vendeur WHERE nom = ?');

		$req->execute([$nom]);

		$info = $req->fetch();

		if($password != '')
		{
			$update = $pdo->prepare('UPDATE vendeur SET nom = ?, prenom = ?, date_naissance = ?, site_ratachement = ?, enseigne = ?, email = ?, mot_de_passe = ?, portable = ? WHERE id_vendeur = ?');
			$password = password_hash($password, PASSWORD_BCRYPT);
			$update->execute([$nom, $prenom, $naissance, $site, $enseigne, $email, $password, $telephone, $info->id_vendeur]);

		}
		else
		{
			$update = $pdo->prepare('UPDATE vendeur SET nom = ?, prenom = ?, date_naissance = ?, site_ratachement = ?, enseigne = ?, email = ?, portable = ? WHERE id_vendeur = ?');
			$update->execute([$nom, $prenom, $naissance, $site, $enseigne, $email, $telephone, $info->id_vendeur]);
			
		}

	}

	function recuperationChallenge($encours, $limite)
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->prepare('SELECT * FROM challenge WHERE en_cours = ? LIMIT '.$limite);

		$req->execute([$encours]);

		$challenge = $req->fetchAll();

		return $challenge;
	}

	function recuperationToutLesChallenges()
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->query('SELECT * FROM challenge');

		$req->execute();

		$challenge = $req->fetchAll();

		return $challenge;
	}

	function recupereDernierMandat($nom)
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->prepare('SELECT * FROM mandat WHERE id_vendeur = (SELECT id_vendeur FROM vendeur WHERE nom = ?)');

		$req->execute([$nom]);

		$mandat = $req->fetch();

		return $mandat;
	}

	function recupereMoisFromVente($mois, $nom)
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->prepare('SELECT id_vente, date_vente, immatriculation, livree, frais_mer, garentie, financement FROM historique_vente WHERE id_vendeur = (SELECT id_vendeur FROM vendeur WHERE nom = ?) AND SUBSTRING(date_vente, 4, 2) = ?');

		$req->execute([$nom, $mois]);

		$mois = $req->fetchAll();

		if(!empty($mois))
		{
			return $mois;
		}

		return null;
	}

	function recupereMoisFromMandat($mois, $nom)
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->prepare('SELECT date_mandat, id_historique, id_vendeur, nombre FROM historique WHERE id_vendeur = (SELECT id_vendeur FROM vendeur WHERE nom = ?) AND SUBSTRING(date_mandat, 4, 2) = ? ORDER BY nombre DESC');

		$req->execute([$nom, $mois]);

		$mois = $req->fetchAll();

		if(!empty($mois))
		{
			return $mois;
		}

		return null;
	}

	function recupereSiteRattachement()
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->query('SELECT site_rattachement FROM site');

		$req->execute();

		$site = $req->fetchAll();

		return $site;
	}

	function insertSiteDeRattachement($site)
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->prepare('INSERT INTO site SET site_rattachement = ?');

		$req->execute([$site]);
	}

	//Fonctions qui correspond au back-office


	function mettreMandatAZero($compteur)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('UPDATE mandat SET nombre = ?');

		$query->execute([$compteur]);
	}

	function mettreVenteAZero()
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('DELETE FROM vente');

		$query->execute();
	}

	function supprimeHistorique()
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->query('DELETE FROM historique');

		$query->execute();
	}

	function recupererTout()
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('SELECT * FROM vendeur');

		$query->execute();

		$res = $query->fetchAll();

		return $res;
	}

	function RecuperationParCollaborateur()
	{
		$pdo = connexionBaseDeDonnee();

		$collaborateur = $pdo->query('SELECT nom, prenom, site_ratachement, nombre, count(historique_vente.id_vendeur) as vente, sum(historique_vente.livree) as livree, sum(historique_vente.financement) as financement, sum(historique_vente.garentie) as garantie, sum(historique_vente.frais_mer) as fme FROM vendeur INNER JOIN mandat ON mandat.id_vendeur = vendeur.id_vendeur LEFT JOIN historique_vente ON mandat.id_vendeur = historique_vente.id_vendeur GROUP BY historique_vente.id_vendeur ORDER BY nombre DESC');

		$collaborateur->execute();

		$res = $collaborateur->fetchAll();

		return $res;
	}

	function RecupParCollaborateurByMonth($mois)
	{
		
		$pdo = connexionBaseDeDonnee();

		$collaborateur = $pdo->prepare('SELECT nom, prenom, site_ratachement, mandat.nombre, count(historique_vente.id_vendeur) as vente, sum(historique_vente.livree) as livree, sum(historique_vente.financement) as financement, sum(historique_vente.garentie) as garantie, sum(historique_vente.frais_mer) as fme FROM vendeur INNER JOIN mandat ON mandat.id_vendeur = vendeur.id_vendeur LEFT JOIN historique_vente ON mandat.id_vendeur = historique_vente.id_vendeur WHERE SUBSTRING(date_vente, 4, 2) = ? GROUP BY historique_vente.id_vendeur ORDER BY vente DESC');

		$collaborateur->execute([$mois]);

		$res = $collaborateur->fetchAll();

		return $res;
	}

	function RecupParCollaborateurByTrim($trimestre)
	{
		
		$pdo = connexionBaseDeDonnee();

		if($trimestre == '1')
		{
			$collaborateur = $pdo->query("SELECT nom, prenom, site_ratachement, mandat.nombre, count(historique_vente.id_vendeur) as vente, sum(historique_vente.livree) as livree, sum(historique_vente.financement) as financement, sum(historique_vente.garentie) as garantie, sum(historique_vente.frais_mer) as fme FROM vendeur INNER JOIN mandat ON mandat.id_vendeur = vendeur.id_vendeur LEFT JOIN historique_vente ON mandat.id_vendeur = historique_vente.id_vendeur WHERE SUBSTRING(date_vente, 4, 2) BETWEEN '01' AND '03' GROUP BY historique_vente.id_vendeur ORDER BY vente DESC");
		}
		elseif($trimestre == '2')
		{
			$collaborateur = $pdo->query("SELECT nom, prenom, site_ratachement, mandat.nombre, count(historique_vente.id_vendeur) as vente, sum(historique_vente.livree) as livree, sum(historique_vente.financement) as financement, sum(historique_vente.garentie) as garantie, sum(historique_vente.frais_mer) as fme FROM vendeur INNER JOIN mandat ON mandat.id_vendeur = vendeur.id_vendeur LEFT JOIN historique_vente ON mandat.id_vendeur = historique_vente.id_vendeur WHERE SUBSTRING(date_vente, 4, 2) BETWEEN '04' AND '06' GROUP BY historique_vente.id_vendeur ORDER BY vente DESC");
		}
		elseif($trimestre == '3')
		{
			$collaborateur = $pdo->query("SELECT nom, prenom, site_ratachement, mandat.nombre, count(historique_vente.id_vendeur) as vente, sum(historique_vente.livree) as livree, sum(historique_vente.financement) as financement, sum(historique_vente.garentie) as garantie, sum(historique_vente.frais_mer) as fme FROM vendeur INNER JOIN mandat ON mandat.id_vendeur = vendeur.id_vendeur LEFT JOIN historique_vente ON mandat.id_vendeur = historique_vente.id_vendeur WHERE SUBSTRING(date_vente, 4, 2) BETWEEN '07' AND '09' GROUP BY historique_vente.id_vendeur ORDER BY vente DESC");
		}
		elseif($trimestre == '4')
		{
			$collaborateur = $pdo->query("SELECT nom, prenom, site_ratachement, mandat.nombre, count(historique_vente.id_vendeur) as vente, sum(historique_vente.livree) as livree, sum(historique_vente.financement) as financement, sum(historique_vente.garentie) as garantie, sum(historique_vente.frais_mer) as fme FROM vendeur INNER JOIN mandat ON mandat.id_vendeur = vendeur.id_vendeur LEFT JOIN historique_vente ON mandat.id_vendeur = historique_vente.id_vendeur WHERE SUBSTRING(date_vente, 4, 2) BETWEEN '10' AND '12' GROUP BY historique_vente.id_vendeur ORDER BY vente DESC");
		}

		$collaborateur->execute();

		$res = $collaborateur->fetchAll();

		return $res;
	}

	function recuperationMoisMandat($mois)
	{
		$pdo = connexionBaseDeDonnee();

		$collaborateur = $pdo->prepare('SELECT nom, prenom, site_ratachement, sum(historique.nombre) as nombre FROM vendeur INNER JOIN historique ON historique.id_vendeur = vendeur.id_vendeur WHERE SUBSTRING(date_mandat, 4, 2) = ? GROUP BY historique.id_vendeur ORDER BY nombre DESC');

		$collaborateur->execute([$mois]);

		$res = $collaborateur->fetchAll();

		return $res;
		
	}

	function recuperationTrimestreMandat($trimestre)
	{
		$pdo = connexionBaseDeDonnee();

		if($trimestre == '1')
		{
			$collaborateur = $pdo->query("SELECT nom, prenom, site_ratachement, sum(historique.nombre) as nombre FROM vendeur INNER JOIN historique ON historique.id_vendeur = vendeur.id_vendeur WHERE SUBSTRING(date_mandat, 4, 2) BETWEEN '01' AND '03' GROUP BY historique.id_vendeur ORDER BY nombre DESC");
		}
		elseif($trimestre == '2')
		{
			$collaborateur = $pdo->query("SELECT nom, prenom, site_ratachement, sum(historique.nombre) as nombre FROM vendeur INNER JOIN historique ON historique.id_vendeur = vendeur.id_vendeur WHERE SUBSTRING(date_mandat, 4, 2) BETWEEN '04' AND '06' GROUP BY historique.id_vendeur ORDER BY nombre DESC");
		}
		elseif($trimestre == '3')
		{
			$collaborateur = $pdo->query("SELECT nom, prenom, site_ratachement, sum(historique.nombre) as nombre FROM vendeur INNER JOIN historique ON historique.id_vendeur = vendeur.id_vendeur WHERE SUBSTRING(date_mandat, 4, 2) BETWEEN '07' AND '09' GROUP BY historique.id_vendeur ORDER BY nombre DESC");
		}
		elseif($trimestre == '4')
		{
			$collaborateur = $pdo->query("SELECT nom, prenom, site_ratachement, sum(historique.nombre) as nombre FROM vendeur INNER JOIN historique ON historique.id_vendeur = vendeur.id_vendeur WHERE SUBSTRING(date_mandat, 4, 2) BETWEEN '10' AND '12' GROUP BY historique.id_vendeur ORDER BY nombre DESC");
		}

		$collaborateur->execute();

		$res = $collaborateur->fetchAll();

		return $res;
	}

	function RecuperationParSiteMandat()
	{
		$pdo = connexionBaseDeDonnee();

		$mandat = $pdo->query("SELECT site_ratachement, sum(mandat.nombre) AS mandat FROM mandat INNER JOIN vendeur ON vendeur.id_vendeur = mandat.id_vendeur GROUP BY vendeur.site_ratachement");

		$mandat->execute();

		$res = $mandat->fetchAll();

		return $res;
	}

	function RecuperationParSiteVente()
	{
		$pdo = connexionBaseDeDonnee();

		$vente = $pdo->query("SELECT site_ratachement, count(historique_vente.id_vendeur) as vente FROM mandat INNER JOIN vendeur ON mandat.id_vendeur = vendeur.id_vendeur INNER JOIN historique_vente ON historique_vente.id_vendeur = mandat.id_vendeur GROUP BY vendeur.site_ratachement");

		$vente->execute();

		$res = $vente->fetchAll();

		return $res;
	}

	function RecuperationParConsolidation()
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare("SELECT nom, prenom, email, nombre as mandat, count(historique_vente.id_vendeur) as vente FROM vendeur LEFT JOIN mandat ON vendeur.id_vendeur = mandat.id_vendeur INNER JOIN historique_vente ON vendeur.id_vendeur = historique_vente.id_vendeur WHERE (SUBSTRING_INDEX(SUBSTR(email, INSTR(email, '@') + 1),'.',1)) = 'viaautomobile' GROUP BY historique_vente.id_vendeur");

		$query->execute();

		$res = $query->fetchAll();

		return $res;
	}

	function recuperationChallengeById($id)
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->prepare('SELECT * FROM challenge WHERE id_challenge = ?');

		$req->execute([$id]);

		$challenge = $req->fetch();

		return $challenge;
	}

	function insertChallenge($titre, $periode, $description, $image, $image_accueil)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('INSERT INTO challenge SET titre = ?, periode = ?, description = ?, image = ?, image_accueil = ?');

		$query->execute([$titre, $periode, $description, $image, $image_accueil]);
	}

	function updateChallenge($id, $titre, $periode, $description, $image, $encours, $vainqueur, $image_accueil)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('UPDATE challenge SET titre = ?, periode = ?, description = ?, image = ?, en_cours = ?, vainqueur = ?, image_accueil = ? WHERE id_challenge = ?');

		$query->execute([$titre, $periode, $description, $image, $encours, $vainqueur, $image_accueil, $id]);
	}

	function deleteChallenge($id)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('DELETE FROM challenge WHERE id_challenge = ?');

		$query->execute([$id]);
	}

	function is_vainqueur()
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->query('SELECT nom, prenom, nombre, count(vente.id_vendeur) as vente FROM vendeur INNER JOIN mandat ON mandat.id_vendeur = vendeur.id_vendeur LEFT JOIN vente ON mandat.id_vendeur = vente.id_vendeur GROUP BY vente.id_vendeur');

		$req->execute();

		$vainqueur = $req->fetchAll();

		return $vainqueur;
	}

	function recupereImageAccueil()
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->query('SELECT image_accueil FROM challenge WHERE en_cours = 1');

		$req->execute();

		$image = $req->fetch();

		return $image;
	}

	function enTeteChallengeVente()
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->query('SELECT nom, prenom, count(vente.id_vendeur) as vente FROM vendeur INNER JOIN vente ON vente.id_vendeur = vendeur.id_vendeur GROUP BY vente.id_vendeur ORDER BY vente DESC LIMIT 1');

		$req->execute();

		$entete = $req->fetch();

		return $entete;
	}

	function enTeteChallengeMandat()
	{
		$pdo = connexionBaseDeDonnee();

		$req = $pdo->query('SELECT nom, prenom, nombre FROM vendeur INNER JOIN mandat ON mandat.id_vendeur = vendeur.id_vendeur ORDER BY mandat.nombre DESC LIMIT 1');

		$req->execute();

		$entete = $req->fetch();

		return $entete;
	}

	function recuperationToutMandat()
	{
		$pdo = connexionBaseDeDonnee();

		$collaborateur = $pdo->prepare('SELECT nom, prenom, site_ratachement, sum(historique.nombre) as nombre FROM vendeur INNER JOIN historique ON historique.id_vendeur = vendeur.id_vendeur GROUP BY historique.id_vendeur ORDER BY nombre DESC');

		$collaborateur->execute([$mois]);

		$res = $collaborateur->fetchAll();

		return $res;
	}

	function insertAdmin($email)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('INSERT INTO administrateur SET email = ?');

		$query->execute([$email]);
	}

	function recuperationAdmin()
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->query('SELECT email FROM administrateur');

		$query->execute();

		$admin = $query->fetchAll(PDO::FETCH_COLUMN);

		return $admin;
	}

	function checkEmailAdmin($email)
	{
		$pdo = connexionBaseDeDonnee();

		$query = $pdo->prepare('SELECT id_admin FROM administrateur WHERE email = ?');
		
		$query->execute([$email]);
		
		$mail = $query->fetch();

		if($mail != null)
		{
			return true;
		}

		return false;
	}

	$droit = recuperationAdmin();

?>