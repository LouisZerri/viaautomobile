<?php 
	
	require "include/header.php";
	require "bdd/database.php";
	require "include/functions.php";

	setlocale(LC_TIME, 'fr_FR.UTF8');
	logged_only();

	$nom = $_SESSION['auth']->nom;
	$prenom = $_SESSION['auth']->prenom;
	$email = $_SESSION['auth']->email;

	$donnee = recupereMandat($nom);

	$nb_vente = countVente($nom);

	$livree = countLivree($nom);
	$frais_mer = countFraisMER($nom);
	$garentie = countGarentie($nom);
	$financement = countFinancement($nom);

	$str = week2str( date('Y'), (date('W') - 1) )."\n";

	//Remet les mandats et les ventes à 0 tous les premiers du mois
	if(date("j") == 1 && date("H:i") == '00:00')
	{
		mettreVenteAZero();
		mettreMandatAZero(0);
	}

?>

<style>

html, body
{
	font-family: 'Montserrat';
	text-decoration: none;
	list-style-type: none;
	background: white;
}

.form-control
{
	font-size: 15px;
}

h2
{
	color: #531B51;
}


@media screen and (min-width: 1080px) and (max-width: 1360px) {

  	#semaine
  	{
  		font-size: 30px;
  		padding-left: 150px;

  	}

  	#colonne1 {
		position: absolute; 
		width: 60%; 
		height: 60%;
		bottom:0; 
		left:0;
		top: 0;
		right:0;  
		margin: auto;
		margin-left: 50px;
		margin-bottom: 175px;
		zoom:125%;
	}

	#colonne2
	{
		position: absolute; 
		width: 38%; 
		height: 59.9%;
		bottom:0;
		top: 0;  
		margin: auto;
		margin-left: 525px;
		margin-bottom: 175px;
		zoom:125%;
	}

	.separation2
	{
		clear: both;
		position: absolute;
		height: 800px;
		width: 3px;
		margin-left: 600px;
		margin-top: 50px;
		background:  #531B51;
	}

	.bouton1
	{
		width: 75px;
		height: 75px;
		background:#A73C97;
		font:bold 55px Montserrat;
		border-radius:50%;
		border:none;
		color:#fff;
	}

	#dont
	{
		color: #A73C97; 
		font-size: 30px;
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

@media screen and (min-height: 770px) and (max-height: 1920px) {
  	
  	#semaine
  	{
  		font-size: 30px;
  		padding-left: 150px;
  	}

	#colonne1 
	{
		position: absolute; 
		width: 60%; 
		height: 60%;
		bottom:0; 
		left:0;
		top: 0;
		right:0;  
		margin: auto;
		margin-left: 50px;
		margin-bottom: 175px;
		zoom:125%;
	}

	#colonne2
	{
		position: absolute; 
		width: 38%; 
		height: 59.9%;
		bottom:0;
		top: 0;  
		margin: auto;
		margin-left: 525px;
		margin-bottom: 175px;
		zoom:125%;
	}

	.separation2
	{
		clear: both;
		position: absolute;
		height: 800px;
		width: 3px;
		margin-left: 600px;
		margin-top: 50px;
		background:  #531B51;
	}

	.bouton1
	{
		width: 75px;
		height: 75px;
		background:#A73C97;
		font:bold 55px Montserrat;
		border-radius:50%;
		border:none;
		color:#fff;
	}

	#dont
	{
		color: #A73C97; 
		font-size: 30px;
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
	##Device = Tablets, Ipads (portrait)
	##Screen = B/w 768px to 1024px
	*/

	@media (min-width: 768px) and (max-width: 1024px) 
	{
		#semaine
	  	{
	  		font-size: 20px;
	  		padding-left: 150px;
	  	}

		#colonne1 
		{
			position: absolute; 
			width: 60%; 
			height: 60%;
			bottom:0; 
			left:0;
			top: 0;
			right:0;  
			margin: auto;
			margin-left: 350px;
			margin-bottom: 350px;
			zoom:100%;
		}

		#colonne2
		{
			position: absolute; 
			width: 50%; 
			height: 5%;
			top: 0;  
			margin: auto;
			margin-left: 240px;
			margin-top: 650px;
			zoom:100%;
		}

		.separation2
		{
			transform: rotate(90deg);
			clear: both;
			position: absolute;
			height: 300px;
			width: 3px;
			margin-left: 470px;
			margin-top: 350px;
			background:  #531B51;
		}

		.bouton1
		{
			width: 75px;
			height: 75px;
			background:#A73C97;
			font:bold 55px Montserrat;
			border-radius:50%;
			border:none;
			color:#fff;
		}

		#dont
		{
			color: #A73C97; 
			font-size: 30px;
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
		#semaine
		{
			font-size: 25px;
			margin-left: 200px;
		}

		#colonne1 
		{
			position: absolute; 
			width: 60%; 
			height: 60%;
			bottom:0; 
			left:0;
			top: 0;
			right:0;  
			margin: auto;
			margin-left: 180px;
			margin-bottom: 175px;
		}

		#colonne2
		{
			position: absolute; 
			width: 40%; 
			height: 60%;
			bottom:0;
			top: 0;  
			margin: auto;
			margin-left: 600px;
			margin-bottom: 175px;
			zoom: 0;
		}

		.separation2
		{
			transform: rotate(180deg);
			clear: both;
			position: absolute;
			height: 600px;
			width: 3px;
			margin-left: 610px;
			margin-top: 50px;
			background:  #531B51;
		}

		.bouton1
		{
			width: 75px;
			height: 75px;
			background:#A73C97;
			font:bold 55px Montserrat;
			border-radius:50%;
			border:none;
			color:#fff;
		}

		#dont
		{
			color: #A73C97; 
			font-size: 30px;
		}

		.separation
		{
			position: fixed;
			margin-left: 300px;
			height: 150%;
			width: 1px;
			background: grey;
			top: 0;
			bottom: 0;
			opacity: 0.2;
		}
	}

	/* Ipad Pro */
	@media only screen and (min-device-width: 1024px) and (max-device-height: 1366px) and (-webkit-min-device-pixel-ratio: 2)  and (orientation: portrait)
	{
		#colonne1 
		{
			position: absolute; 
			width: 60%; 
			height: 60%;
			bottom:0; 
			left:0;
			top: 0;
			right:0;  
			margin: auto;
			margin-left: 350px;
			margin-bottom: 450px;
		}

		#colonne2
		{
			position: absolute; 
			width: 50%; 
			height: 59.9%;
			bottom:0;
			top: 0;  
			margin: auto;
			margin-left: 340px;
			padding-top: 400px;
		}

		.separation2
		{
			transform: rotate(90deg);
			clear: both;
			position: absolute;
			height: 300px;
			width: 3px;
			margin-left: 575px;
			margin-top: 350px;
			background:  #531B51;
		}

		#semaine
		{
			margin-left: 150px;
		}

	}

	@media only screen and (min-device-width: 1366px) and (max-device-height: 1024px) and (-webkit-min-device-pixel-ratio: 2)  and (orientation: landscape)
	{
		#colonne1 
		{
			position: absolute; 
			width: 60%; 
			height: 60%;
			bottom:0; 
			left:0;
			top: 0;
			right:0;  
			margin: auto;
			margin-left: 85px;
			margin-bottom: 175px;
		}

		#semaine
		{
			margin-left: 50px;
		}

		#colonne2
		{
			position: absolute; 
			width: 60%; 
			height: 60%;
			bottom:0;
			top: 0;  
			margin: auto;
			margin-left: 410px;
			margin-bottom: 175px;
		}

		.separation2
		{
			transform: rotate(180deg);
			clear: both;
			position: absolute;
			height: 400px;
			width: 3px;
			margin-left: 650px;
			margin-top: 100px;
			background:  #531B51;
		}
	}
</style>
<div class="separation"></div>
<div class="menu">
	</br>
	</br>
	<a href="accueil.php"><img style="padding-left: 35px;" src="style/logo_final.png" alt="logo" width="250"></a></br></br></br>
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

<center>
	<div class="container mt-1">
	<?php if(isset($_SESSION['flash'])): ?>
		<?php foreach($_SESSION['flash'] as $type => $message): ?>
			<div style="margin-left: 150px;" class="alert alert-<?= $type;?> alert-dismissible fade show" role="alert">
				<?= $message; ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php endforeach; ?>
		<?php unset($_SESSION['flash']); ?>
	<?php endif; ?>
		<p style="color: #531B51;" id="semaine"><?= $str ?></p>
		<div class="row ml-4">
			<div id="colonne1" class="col">
				<h3 style="color: #531B51;"><b>NOMBRE DE MANDATS</b></h3>
				<p class="nombre_mandat" style="font-size: 7em; color: #531B51;"><?= $donnee->nombre ?></p>
				<p style="font-size: 2em; color: #531B51;">Mandats</p></br>
				<a href="#?w=500" rel="popupun" id="poplight" style="background-color: #531B51; text-decoration: none; border: 2px solid #531B51; border-radius: 12px;" class="btn btn-light" role="button"><span>Ajouter Mandats</span></a>
			</div>
			<div>
				<hr class="separation2" />
			</div>
			<div id="colonne2" class="col">
				<center>
					<h3 style="color: #531B51;"><b>NOMBRE DE VENTES</b></h3>
					<p style="font-size: 7em; color: #531B51;"><?= $nb_vente; ?></p>
					<p style="font-size: 2em; color: #531B51;">Ventes</p>
					<p id="dont">dont</p></br>
					<div class="row pl-4">
						<div class="col pl-2">
							<button class="bouton1"><?= $livree ?></button>
							<span style="color: black;">Livraisons</span>
						</div>
						<div class="col">
							<button class="bouton1"><?= $frais_mer ?></button></br>
							<span style="color: black;">Frais de mise en service</span>
						</div>
						<div class="col pl-2">
							<button class="bouton1"><?= $garentie ?></button>
							<span style="color: black;">Garanties</span>
						</div>
						<div class="col pl-2">
							<button class="bouton1"><?= $financement ?></button>
							<span style="color: black;">Financements</span>
						</div>
					</div></br>
					<a href="#?w=750" rel="popupdeux" id="poplight2" style="background-color: #531B51; text-decoration: none; border: 2px solid #531B51; border-radius: 12px;" class="btn btn-light" role="button"><span>Ajouter Ventes</span></a>
				</center>
			</div>
		</div>
	</div>
</center>

<div id="popupun" class="popup_block">
	<center>
		<div class="container">
			<h2>AJOUT DE MANDATS</h2></br> 
			<p style="font-size: 15px; color: #531B51;">Combien de mandats</br>souhaitez-vous comptabiliser ?</p></br>
			<form action="actualise_mandat.php" method="POST">
				<div class="form-group">
					<input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre">	
				</div></br>
		        <button rel="popuptrois" id="poplight3" style="background-color: #9D1458;" type="submit" class="btn btn-light"><span style="color: white;">Ajouter</span></button>
			</form>
		</div>
	</center>
</div>

<div id="popupdeux" class="popup_block">
	<div class="container">
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
		<center>
			<h2>AJOUT D'UNE VENTE</h2></br> 
		</center>
		<form action="actualise_vente.php" method="POST">
			<div class="form-group">
				<label for="">Date de la vente</label>
				<input class="form-control" type="text" name="date_vente" placeholder="01/01/1900">	
			</div>
			<div class="form-group">
				<label for="">Immatriculation du véhicule</label>
				<input class="form-control" type="text" name="immatriculation" placeholder="AA123BB">	
			</div>
			<div class="row">
				<div class="col-sm">
					<label>Livrée : </label>
					<div class="form-check">
  						<input class="form-check-input" name="livree[]" type="checkbox" value="Oui" id="defaultCheck1">
  						<label class="form-check-label" for="defaultCheck1">Oui</label>
					</div>
					<div class="form-check">
  						<input class="form-check-input" name="livree[]" type="checkbox" value="Non" id="defaultCheck1">
  						<label class="form-check-label" for="defaultCheck1">Non</label>
					</div>
				</div>
				<div class="col-sm">
					<label>Frais de mise à la route : </label>
					<div class="form-check">
  						<input class="form-check-input" name="frais_mer[]" type="checkbox" value="Oui" id="defaultCheck1">
  						<label class="form-check-label" for="defaultCheck1">Oui</label>
					</div>
					<div class="form-check">
  						<input class="form-check-input" name="frais_mer[]" type="checkbox" value="Non" id="defaultCheck1">
  						<label class="form-check-label" for="defaultCheck1">Non</label>
					</div>
				</div>
				<div class="col-sm">
					<label>Garantie : </label>
					<div class="form-check">
  						<input class="form-check-input" name="garentie[]" type="checkbox" value="Oui" id="defaultCheck1">
  						<label class="form-check-label" for="defaultCheck1">Oui</label>
					</div>
					<div class="form-check">
  						<input class="form-check-input" name="garentie[]" type="checkbox" value="Non" id="defaultCheck1">
  						<label class="form-check-label" for="defaultCheck1">Non</label>
					</div>
				</div>
				<div class="col-sm">
					<label>Financement : </label>
					<div class="form-check">
  						<input class="form-check-input" name="financement[]" type="checkbox" value="Oui" id="defaultCheck1">
  						<label class="form-check-label" for="defaultCheck1">Oui</label>
					</div>
					<div class="form-check">
  						<input class="form-check-input" name="financement[]" type="checkbox" value="Non" id="defaultCheck1">
  						<label class="form-check-label" for="defaultCheck1">Non</label>
					</div>
				</div>
			</div></br></br>
			<center>
	        	<button style="background-color: #9D1458;" type="submit" class="btn btn-light"><span style="color: white;">Ajouter</span></button>
	        </center>
		</form>
	</div>

</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script type="text/javascript">
	
$(document).ready(function() {

	//Popup 1
	$('a#poplight[href^=#]').click(function() {
		var popID = $(this).attr('rel'); //Trouver la pop-up correspondante
		var popURL = $(this).attr('href'); //Retrouver la largeur dans le href

		//Récupérer les variables depuis le lien
		var query= popURL.split('?');
		var dim= query[1].split('&amp;');
		var popWidth = dim[0].split('=')[1]; //La première valeur du lien

		//Faire apparaitre la pop-up
		$('#' + popID).fadeIn().css({
			'width': Number(popWidth)
		})

		//Récupération du margin, qui permettra de centrer la fenêtre - on ajuste de 80px en conformité avec le CSS
		var popMargTop = ($('#' + popID).height() + 80) / 2;
		var popMargLeft = ($('#' + popID).width() + 80) / 2;

		//On affecte le margin
		$('#' + popID).css({
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});

		//Effet fade-in du fond opaque
		$('body').append('<div id="fade"></div>'); //Ajout du fond opaque noir
		//Apparition du fond - .css({'filter' : 'alpha(opacity=80)'}) pour corriger les bogues de IE
		$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();

		return false;
	});

	//Popup 2
	$('a#poplight2[href^=#]').click(function() {
		var popID = $(this).attr('rel'); //Trouver la pop-up correspondante
		var popURL = $(this).attr('href'); //Retrouver la largeur dans le href

		//Récupérer les variables depuis le lien
		var query= popURL.split('?');
		var dim= query[1].split('&amp;');
		var popWidth = dim[0].split('=')[1]; //La première valeur du lien

		//Faire apparaitre la pop-up
		$('#' + popID).fadeIn().css({
			'width': Number(popWidth)
		})

		//Récupération du margin, qui permettra de centrer la fenêtre - on ajuste de 80px en conformité avec le CSS
		var popMargTop = ($('#' + popID).height() + 80) / 2;
		var popMargLeft = ($('#' + popID).width() + 80) / 2;

		//On affecte le margin
		$('#' + popID).css({
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});

		//Effet fade-in du fond opaque
		$('body').append('<div id="fade"></div>'); //Ajout du fond opaque noir
		//Apparition du fond - .css({'filter' : 'alpha(opacity=80)'}) pour corriger les bogues de IE
		$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();

		return false;
	});

	//Popup3
	$('#poplight3').click(function(e) {

		e.preventDefault();

	 	var nombre = $("#nombre").val();

	 	jQuery.ajax({
	 		url : 'actualise_mandat.php',
	 		method: 'POST',
	 		data : {
	 			nombre: nombre
	 		},
	 		success: function(data, text, jqxhr)
	 		{
	 			$('.nombre_mandat').html(jqxhr.responseText);

				$('#fade , .popup_block').fadeOut(function() {
					$('#fade, a.close').remove();  //...ils disparaissent ensemble
				});
				$('form').find('input').val("");
	 		},
	 		error: function(jqxhr)
	 		{
	 			alert(jqxhr.responseText);
	 		}
	 	});

		var popID = $(this).attr('rel'); //Trouver la pop-up correspondante
		var popURL = 500; //Retrouver la largeur dans le href

		//Récupérer les variables depuis le lien
		var query= popURL.split('?');
		var dim= query[1].split('&amp;');
		var popWidth = dim[0].split('=')[1]; //La première valeur du lien

		//Faire apparaitre la pop-up
		$('#' + popID).fadeIn().css({
			'width': Number(popWidth)
		})

		//Récupération du margin, qui permettra de centrer la fenêtre - on ajuste de 80px en conformité avec le CSS
		var popMargTop = ($('#' + popID).height() + 80) / 2;
		var popMargLeft = ($('#' + popID).width() + 80) / 2;

		//On affecte le margin
		$('#' + popID).css({
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});

		//Effet fade-in du fond opaque
		$('body').append('<div id="fade"></div>'); //Ajout du fond opaque noir
		//Apparition du fond - .css({'filter' : 'alpha(opacity=80)'}) pour corriger les bogues de IE
		$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();

		return false;
	});

	//Fermeture de la pop-up et du fond
	$('a.close, #fade').live('click', function() { //Au clic sur le bouton ou sur le calque...
		$('#fade , .popup_block').fadeOut(function() {
			$('#fade, a.close').remove();  //...ils disparaissent ensemble
		});

		return false;
	});
});
</script>

<?php require "include/footer.php"; ?>