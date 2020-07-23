<?php 

	require "include/header.php";
	require "bdd/database.php";
	require "include/functions.php";

	logged_only();
	erreurs();

	$nom = $_SESSION['auth']->nom;
	$prenom = $_SESSION['auth']->prenom;
	$email = $_SESSION['auth']->email;

	/*$lesChallengesEnCours = recuperationChallenge(1,1);
	$lesChallengesPasses = recuperationChallenge(0,2);*/

	$lesChallengesEnCours = recuperationChallenge(1,5);
	$lesChallengesPasses = recuperationChallenge(0,5);

	$enTeteMandat = enTeteChallengeMandat();
	$enTeteVente = enTeteChallengeVente();

?>
<style>

html, body
{
	font-family: 'Montserrat';
	text-decoration: none;
	list-style-type: none;
	background: white;
}

@media screen and (min-width: 1080px) and (max-width: 1360px) {

	body
	{
		font-family: 'Montserrat';
		text-decoration: none;
		list-style-type: none;
		color: #531B51;
	}

	.menu
	{
		width: 500px;
		height: 400px;
		float: left;
		position: fixed;

	}

	#screen
	{
		position: absolute; 
		bottom:0; 
		left:0;
		top: 0;
		right:0;  
		margin: auto;
		margin-left: 100px;
		padding-top: 20px;
		zoom: 125%;
	}

	.separation
	{
		
		position: fixed;
		margin-left: 300px;
		height: 100%;
		width: 1px;
		background: grey;
		top: 0;
		bottom: 0;
		opacity: 0.2;
	}

}


@media screen and (min-height: 770px) and (max-height: 1920px) {

	body
	{
		font-family: 'Montserrat';
		text-decoration: none;
		list-style-type: none;
		color: #531B51;
	}

	.menu
	{
		width: 500px;
		height: 400px;
		float: left;
		position: fixed;
		z-index: 10;
	}

	#screen
	{
		position: absolute; 
		bottom:0; 
		left:0;
		top: 0;
		right:0;  
		margin: auto;
		margin-left: 100px;
		padding-top: 20px;
		zoom: 125%;

	}

	.separation
	{
		
		position: fixed;
		margin-left: 300px;
		height: 100%;
		width: 1px;
		background: grey;
		top: 0;
		bottom: 0;
		opacity: 0.2;
	}

}

/* 
	##Device = Tablets, Ipads (portrait)
	##Screen = B/w 768px to 1024px
	*/

	@media (min-width: 768px) and (max-width: 1024px) 
	{

		.menu
		{
			width: 500px;
			height: 400px;
			float: left;
			position: fixed;
			z-index: 10;
		}

		#screen
		{
			position: absolute; 
			bottom:0; 
			left:0;
			top: 0;
			right:0;  
			margin: auto;
			margin-left: 150px;
			padding-top: 20px;
			zoom: 100%;

		}

		.separation
		{
			
			position: absolute;
			margin-left: 300px;
			height: 100%;
			width: 1px;
			background: grey;
			top: 0;
			bottom: 0;
			opacity: 0.2;
		}
	}

	/* 
	##Device = Tablets, Ipads (landscape)
	##Screen = B/w 768px to 1024px
	*/

	@media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) 
	{

		#screen
		{
			position: absolute; 
			bottom:0; 
			left:0;
			top: 0;
			right:0;  
			margin: auto;
			margin-left: 110px;
			padding-top: 20px;
		}

		.separation
		{
			
			position: fixed;
			margin-left: 300px;
			height: 100%;
			width: 1px;
			background: grey;
			top: 0;
			bottom: 0;
			opacity: 0.2;
		}
	}


</style>
<div class="separation"></div>
<div class="menu">
	</br>
	</br>
	<a href="accueil.php"><img style="padding-left: 35px; z-index:10; position: relative;" src="style/logo_final.png" alt="logo" width="250"></a></br></br></br>
	<p style="padding-left: 45px; color: #531B51;">Bonjour <b><?= $prenom; ?> <?= $nom; ?></b></p>
	</br>
	<ul>
		<li><a id="change" href="challenges.php"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;Les challenges</a></li></br>
		<li><a id="change" href="tableau_de_bord.php"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Mon tableau de bord</a></li></br>
		<li><a id="change" href="historique.php"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;Historique</a></li></br>
		<?php if(in_array($email, $droit)) :?>
			<li><a id="change" href="backoffice.php"><i class="fa fa-pie-chart" aria-hidden="true"></i>&nbsp;Administration</a></li></br>
		<?php endif; ?>
		<li><a id="change" href="parametre_compte.php"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;Paramètres du compte</a></li></br>
		<li><a id="change" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Deconnexion</a></li></br>
	</ul>
	<img style="position: fixed; left: 0; bottom: 0; padding-left: 15px;" src="style/logo_gris.svg" alt="logo" width="230">
</div>
<div id="screen" class="container mt-2" style="padding-left: 200px;">

		<?php if(isset($_SESSION['flash'])): ?>
			<?php foreach($_SESSION['flash'] as $type => $message): ?>
				<div class="alert alert-<?= $type;?> alert-dismissible fade show" role="alert">
				  	<?= $message; ?>
				  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    			<span aria-hidden="true">&times;</span>
		  			</button>
				</div>
		  	<?php endforeach; ?>
		  	<?php unset($_SESSION['flash']); ?>
		<?php endif; ?>

		<h3 style="color: #531B51;"><b>LES CHALLENGES EN COURS</b></h3>
		</br>
		<?php if($lesChallengesEnCours): ?>
			<?php foreach($lesChallengesEnCours as $challenge): ?>
				<div class="row mt-3">
					<div class="col">
						<img style="border-radius: 10px;" src="style/<?= $challenge->image; ?>" width="225" height="150">
					</div>
					<div class="col mt-3">
						<h5 style="color: #531B51;"><b><?= $challenge->titre; ?></b></h5>
						<span style="color: #808080; font-size: 12px;">Période : <?= $challenge->periode; ?></span></br>
						<span style="color: black; font-size: 15px;"><?= $challenge->description; ?></span>
						<div class="row">
							<div class="col">
								<span style="color: black; font-size: 12px;">🥇 <?= $enTeteMandat->prenom ?> <?= $enTeteMandat->nom ?> (<?= $enTeteMandat->nombre ?> Mandats)</span>
							</div>
							<?php if($enTeteVente): ?>
								<div class="col">
									<span style="color: black; font-size: 12px;">🥇 <?= $enTeteVente->prenom ?> <?= $enTeteVente->nom ?> (<?= $enTeteVente->vente ?> Ventes)</span>
								</div>
							<?php else: ?>
								<div class="col">
									<span style="color: black; font-size: 12px;">🥇 Personne en tête des ventes</span>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="alert alert-info mt-3" role="alert">
	 			<i class="fa fa-info"></i>&nbsp;&nbsp;Aucun challenge en cours pour le moment
			</div>
		<?php endif; ?>
		</br></br>
		<h3 style="color: #531B51;"><b>LES CHALLENGES PASSÉS</b></h3>
		</br>
		<?php foreach($lesChallengesPasses as $challenge): ?>
			<div class="row mt-3">
				<div class="col">
					<img style="border-radius: 10px;" src="style/<?= $challenge->image; ?>" width="225" height="150">
				</div>
				<div class="col mt-3">
					<h5 style="color: #531B51;"><b><?= $challenge->titre; ?></b></h5>
					<span style="color: #808080; font-size: 12px;">Période : <?= $challenge->periode; ?></span></br>
					<span style="color: black; font-size: 15px;"><?= $challenge->description; ?></br></span>
					<span style="color: black; font-size: 15px;"><b>Vainqueur :</b> <?= $challenge->vainqueur ?></span>
				</div>
			</div></br>
		<?php endforeach; ?>
</div>

<?php require "include/footer.php"; ?>