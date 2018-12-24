<?php 
	
	require "include/header.php";
	require "bdd/database.php";
	require "include/functions.php";

	logged_only();

	$nom = $_SESSION['auth']->nom;
	$prenom = $_SESSION['auth']->prenom;

	$donnee = recupereMandat($nom);

	$nb_vente = countVente($nom);

	$livree = countLivree($nom);
	$frais_mer = countFraisMER($nom);
	$garentie = countGarentie($nom);
	$financement = countFinancement($nom);

	//Partie reservée au back-office

	$semaine = recupereSemaine();
?>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<style>

body
{
	font-family: 'Montserrat';
	text-decoration: none;
	list-style-type: none;
	color: #531B51;
}
.menu
{
	width: 300px;
	height: 400px;
	float: left;

}

.separation
{
	
	position: absolute;
	margin-left: 270px;
	height: 100%;
	width: 1px;
	background: grey;
	top: 0;
	bottom: 0;
	opacity: 0.2;
}

.separation2
{
	clear: both;
	position: absolute;
	margin-left: 5px;
	height: 450px;
	width: 3px;
	margin-top: 50px;
	background:  #531B51;
}

li
{
	list-style-type: none;
}

span
{
	color: white;
}


	/*-----------------------------------------------*/

#fade { /*--Masque opaque noir de fond--*/
	display: none; /*--masqué par défaut--*/
	background: #000;
	position: fixed; left: 0; top: 0;
	width: 100%; height: 100%;
	opacity: .80;
	z-index: 9999;
}
.popup_block{
	display: none; /*--masqué par défaut--*/
	background: #fff;
	padding: 20px;
	float: left;
	font-size: 12px;
	position: fixed;
	top: 50%; left: 50%;
	z-index: 99999;
	/*--Les différentes définitions de Box Shadow en CSS3--*/
	-webkit-box-shadow: 0px 0px 20px #000;
	-moz-box-shadow: 0px 0px 20px #000;
	box-shadow: 0px 0px 20px #000;
	/*--Coins arrondis en CSS3--*/
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
}

/*--Gérer la position fixed pour IE6--*/
*html #fade {
position: absolute;
}
*html .popup_block {
position: absolute;
}

.bouton1
{
	width: 65px;
	height: 65px;
	background:#A73C97;
	font:bold 50px Montserrat;
	border-radius:50%;
	border:none;
	color:#fff;
}

#change
{
	color: #531B51;
	text-decoration: none;
	list-style-type: none;
}

#change:hover
{
	color: white;
	transition:all 0.10s;
	border:none;
	padding: 10px 10px 10px 10px;
	border-radius: 20px;
	background: #754974;
}

#dont
{
	color: #A73C97; 
	font-size: 20px;
}

@media screen and (min-width: 1390px) and (max-width: 5000px) {
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
		margin-bottom: 350px;
		font-size: 2em;

	}

	#colonne2{
		position: absolute; 
		width: 38%; 
		height: 60%;
		bottom:0;
		top: 0;  
		margin: auto;
		margin-left: 600px;
		margin-bottom: 350px;
		font-size: 2em;
	}

	.separation2
	{
		clear: both;
		position: absolute;
		height: 800px;
		width: 3px;
		margin-left: 500px;
		margin-top: 200px;
		background:  #531B51;
	}

	.bouton1
	{
		width: 150px;
		height: 150px;
		background:#A73C97;
		font:bold 100px Montserrat;
		border-radius:50%;
		border:none;
		color:#fff;
	}

	#dont
	{
		color: #A73C97; 
		font-size: 45px;
	}

	.menu
	{
		zoom: 150%;
	}

	.separation
	{
		
		position: absolute;
		margin-left: 400px;
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
	<img style="padding-left: 35px;" src="style/new_logo.svg" alt="logo" width="200"></br></br></br>
	<p style="padding-left: 45px;">Bonjour <b><?= $prenom; ?> <?= $nom; ?></b></p>
	</br>
	<ul>
		<li><a id="change" href="challenges.php"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;Les challenges</a></li></br>
		<li><a id="change" href="tableau_de_bord.php"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Mon tableau de bord</a></li></br>
		<li><a id="change" href="historique.php"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;Historique</a></li></br>
		<li><a id="change" href="#"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;Paramètres du compte</a></li></br>
		<li><a id="change" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Deconnexion</a></li></br>
	</ul>
	<img style="position: absolute; left: 0; bottom: 0; padding-left: 15px;" src="style/logo_gris.svg" alt="logo" width="230">
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
		<p>Semaine du <?= $semaine->debut_semaine ?> au <?= $semaine->fin_semaine ?> <?= $semaine->mois ?></p>
		<div class="row ml-4">
			<div id="colonne1" class="col">
				<h3><b>NOMBRE DE MANDATS</b></h3>
				<p style="font-size: 7em;"><?= $donnee->nombre ?></p>
				<p style="font-size: 2em;">Mandats</p></br>
				<a href="#?w=500" rel="popupun" id="poplight" style="background-color: #531B51; text-decoration: none; border: 2px solid #531B51; border-radius: 12px;" class="btn btn-light" role="button"><span>Ajouter Mandats</span></a>
			</div>
			<div>
				<hr class="separation2" />
			</div>
			<div id="colonne2" class="col">
				<center>
					<h3><b>NOMBRE DE VENTES</b></h3>
					<p style="font-size: 7em;"><?= $nb_vente; ?></p>
					<p style="font-size: 2em;">Ventes</p>
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
			<p style="font-size: 15px;">Combien de mandats</br>souhaitez-vous comptabiliser ?</p></br>
			<form action="actualise_mandat.php" method="POST">
				<div class="form-group">
					<input class="form-control" type="text" name="nombre" placeholder="Nombre">	
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
				<input class="form-control" type="text" name="immatriculation" placeholder="AA-123-BB">	
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
	$('#poplight3').click(function() {
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