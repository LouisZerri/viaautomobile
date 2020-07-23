<?php 


	require "include/header.php";
	require "bdd/database.php";
	require "include/functions.php";

	logged_only();

	$nom = $_SESSION['auth']->nom;
	$prenom = $_SESSION['auth']->prenom;
	$email = $_SESSION['auth']->email;

	$donnees = getAllVente($nom);

	$result = recupHistorique($nom);

	$delete_mandat = "delete_mandat.php?id=";
	$delete_vente = "delete_vente.php?id=";

?>
<style>

html, body
{
	font-family: 'Montserrat';
	text-decoration: none;
	list-style-type: none;
	background: white;
}

#select
{
	position: absolute; 
	bottom:0; 
	left:0;
	top: 0;
	right:0;  
	margin: auto;
	z-index: 10;
	margin-left: 350px;
	margin-top: 75px;
}

h3
{
	position: absolute; 
	bottom:0; 
	left:0;
	top: 0;
	right:0;  
	margin: auto;
	margin-left: 300px;
	padding-top: 50px;
}

.form-control
{
	font-size: 15px;
}

table
{
	position: absolute; 
	width: 100%; 
	height: 25%;   
	right: 0; 
	margin: auto;
	zoom: 125%;
	padding-top: 100px;
	margin-right: 50px;
	display: none;
}

#ma_table_Ventes
{
	width: 70%;
}

#ma_table_Mandats
{
	width: 55%;
}


@media screen and (min-width: 1080px) and (max-width: 1360px) {

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

	h3
	{
		position: absolute; 
		bottom:0; 
		left:0;
		top: 0;
		right:0;  
		margin: auto;
		margin-left: 300px;
		padding-top: 50px;
		zoom: 125%;
	}

	select
	{
		position: absolute; 
		bottom:0; 
		left:0;
		top: 0;
		right:0;  
		margin: auto;
		margin-left: 170px;
		margin-top: 50px;
		z-index: 100;
	}

	table
	{
		position: absolute; 
		width: 100%; 
		height: 25%;   
		right: 0; 
		margin: auto;
		zoom: 125%;
		padding-top: 150px;
		margin-right: 50px;
		display: none;
	}

	#ma_table_Ventes
	{
		width: 70%;
	}

	#ma_table_Mandats
	{
		width: 55%;
	}

}

@media screen and (min-height: 770px) and (max-height: 1920px) {

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

	h3
	{
		position: absolute; 
		bottom:0; 
		left:0;
		top: 0;
		right:0;  
		margin: auto;
		margin-left: 300px;
		padding-top: 50px;
		zoom: 125%;
	}

	select
	{
		position: absolute; 
		bottom:0; 
		left:0;
		top: 0;
		right:0;  
		margin: auto;
		margin-left: 170px;
		margin-top: 50px;
		z-index: 100;
	}

	table
	{
		position: absolute; 
		width: 100%; 
		height: 25%;   
		right: 0; 
		margin: auto;
		zoom: 125%;
		padding-top: 150px;
		margin-right: 50px;
		display: none;
	}

	#ma_table_Ventes
	{
		width: 70%;
	}

	#ma_table_Mandats
	{
		width: 55%;
	}



}

/* 
	##Device = Tablets, Ipads (portrait)
	##Screen = B/w 768px to 1024px
	*/

	@media (min-width: 768px) and (max-width: 1024px) 
	{

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

		h3
		{
			position: absolute; 
			bottom:0; 
			left:0;
			top: 0;
			right:0;  
			margin: auto;
			margin-left: 300px;
			padding-top: 50px;
			zoom: 125%;
		}

		select
		{
			position: absolute; 
			bottom:0; 
			left:0;
			top: 0;
			right:0;  
			margin: auto;
			margin-left: 200px;
			margin-top: 100px;
		}

		table
		{
			position: absolute; 
			width: 50%; 
			height: 50%;   
			margin: auto;
			padding-top: 150px;
			margin-right: 200px;
			display: none;
		}

		#ma_table_Ventes
		{
			width: 50%;
		}

		#ma_table_Mandats
		{
			width: 55%;
		}
	}

	/* 
	##Device = Tablets, Ipads (landscape)
	##Screen = B/w 768px to 1024px
	*/

	@media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) 
	{

		.separation
		{
			
			position: fixed;
			margin-left: 300px;
			height: 200%;
			width: 1px;
			background: grey;
			top: 0;
			bottom: 0;
			opacity: 0.2;
		}

		h3
		{
			position: absolute; 
			bottom:0; 
			left:0;
			top: 0;
			right:0;  
			margin: auto;
			margin-left: 300px;
			padding-top: 50px;
			zoom: 125%;
		}

		select
		{
			position: absolute; 
			bottom:0; 
			left:0;
			top: 0;
			right:0;  
			margin-left: 270px;
			margin-top: 50px;
		}

		table
		{
			position: absolute; 
			width: 50%; 
			height: 25%;   
			margin: auto;
			padding-top: 150px;
			padding-right: 20px;
			display: none;
		}

		#ma_table_Ventes
		{
			width: 65%;
		}

		#ma_table_Mandats
		{
			width: 55%;
		}
	}

	/* Ipad Pro */
	@media only screen and (min-device-width: 1024px) and (max-device-height: 1366px) and (-webkit-min-device-pixel-ratio: 2)  and (orientation: portrait)
	{
		select
		{
			position: absolute; 
			bottom:0; 
			left:0;
			top: 0;
			right:0;  
			margin-left: 280px;
			margin-top: 50px;
		}
	}

	@media only screen and (min-device-width: 1366px) and (max-device-height: 1024px) and (-webkit-min-device-pixel-ratio: 2)  and (orientation: landscape)
	{
		
		select
		{
			position: absolute; 
			bottom:0; 
			left:0;
			top: 0;
			right:0;  
			margin-left: 300px;
			margin-top: 50px;
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
<div class="container">
	<h3 style="color: #531B51;"><b>AFFICHER L'HISTORIQUE</b></h3>
	<div id="select" class="row">
		<div class="col mt-5">
			<form action="" method="POST">
				<div class="form-group">
					<select style="width: 50%; background-color: #531B51; color: white;" class="form-control" name="monselect">
						<option selected="selected"><span>Type d'action</span></option>
						<option>Ventes</option>
						<option>Mandats</option>
					</select>
  				</div>
			</form>
		</div>
		<div class="col mt-5">
			<form action="test.php" method="POST">
				<div class="form-group">
					<select name="mois" style="width: 50%; background-color: #531B51; color: white;" class="form-control">
						<option id="periode" selected="selected"><span>Période</span></option>
						<option id="01">Janvier</option>
						<option id="02">Février</option>
						<option id="03">Mars</option>
						<option id="04">Avril</option>
						<option id="05">Mai</option>
						<option id="06">Juin</option>
						<option id="07">Juillet</option>
						<option id="08">Août</option>
						<option id="09">Septembre</option>
						<option id="10">Octobre</option>
						<option id="11">Novembre</option>
						<option id="12">Décembre</option>
					</select>
  				</div>
			</form>
		</div>
	</div>
	</div>

	<table id="ma_table_Ventes" class="table table-striped ml-5 mt-5">
		<thead>
			<tr>
  				<th scope="col">Date de vente</th>
		      	<th scope="col">Immatriculation</th>
		      	<th scope="col">Livraisons</th>
		      	<th scope="col">FMS</th>
		      	<th scope="col">Garanties</th>
		      	<th scope="col">Financements</th>
		      	<th scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1 ?>
			<?php foreach($donnees as $res): ?>
				<tr id="tableau">
					<td align="center" id="date_vente"><?= $res->date_vente; ?></td>
					<td align="center"><?= $res->immatriculation; ?></td>
					<?php if($res->livree == 1): ?>
						<td align="center" style="font-weight: bold; color: #531B51;">Oui</td>
					<?php else: ?>
						<td align="center">Non</td>
					<?php endif; ?>
					<?php if($res->frais_mer == 1): ?>
						<td align="center" style="font-weight: bold; color: #531B51;">Oui</td>
					<?php else: ?>
						<td align="center">Non</td>
					<?php endif; ?>
					<?php if($res->garentie == 1): ?>
						<td align="center" style="font-weight: bold; color: #531B51;">Oui</td>
					<?php else: ?>
						<td align="center" >Non</td>
					<?php endif; ?>
					<?php if($res->financement == 1): ?>
						<td align="center" style="font-weight: bold; color: #531B51;">Oui</td>
					<?php else: ?>
						<td align="center">Non</td>
					<?php endif; ?>
					<?php if(date("m") != substr($res->date_vente,3,2)): ?>
						<td align="center"><a style="color: black;" ><i class="fa fa-times"></i></a></td>
					<?php else: ?>
						<td align="center"><a id="vente" style="color: black;" href="<?= $delete_vente."".$res->id_vente ?>"><i class="fa fa-trash"></i></a></td>
					<?php endif; ?>
				</tr>
				<?php $i++; ?>
			<?php endforeach; ?>
		</tbody>
	</table>

	<table id="ma_table_Mandats" class="table table-striped ml-5 mt-5">
		<thead>
			<tr>
  				<th align="center" scope="col">Date</th>
		      	<th align="center" scope="col">Nombre de mandats</th>
		      	<th align="center" scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1 ?>
			<?php foreach($result as $res): ?>
				<tr align="center" id="<?= $i; ?>">
					<td align="center" id="date_mandat"><?= $res->date_mandat; ?></td>
					<td align="center"><?= $res->nombre; ?></td>
					<?php if(date("m") != substr($res->date_mandat,3,2)): ?>
						<td align="center"><a style="color: black;"><i class="fa fa-times"></i></a></td>
					<?php else: ?>
						<td align="center"><a id="mandat" style="color: black;" href="<?= $delete_mandat."".$res->id_historique ?>"><i class="fa fa-trash"></i></a></td>
					<?php endif; ?>
				</tr>
			<?php $i++; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {

		$('a[id="mandat"]').click(function(e){

			e.preventDefault();

			var $a = $(this)

			var url = $a.attr('href')

			jQuery.ajax({
				url : url,
				type : 'GET',
				success: function()
				{
					$a.parents('tr').fadeOut(500);
				},
				error: function(jqxhr)
				{
					alert(jqxhr.responseText);
				}
			});
		});

		$('a[id="vente"]').click(function(e){

			e.preventDefault();

			var $a = $(this)

			var url = $a.attr('href')

			jQuery.ajax({
				url : url,
				type : 'GET',
				success: function()
				{
					$a.parents('tr').fadeOut(500);
				},
				error: function(jqxhr)
				{
					alert(jqxhr.responseText);
				}
			});
		});

		// Je sélectionne le select et quand la valeur change on fait une action
		$('select[name="monselect"]').change(function(){
		    // Je créer l'id du div qui va être affiché
		    var id = "ma_table_" + $(this).val();
		    // Je cache toutes les divs grâce à une classe qui va sélectionner le tout
		    $('table').hide();
		    // Et j'affiche seulement le Div que je souhaite
		    $('#'+id).show();
		});

		$('select[name="mois"]').change(function(e){

			e.preventDefault();

			var mois = $("select[name='mois'] option:selected").attr("id");

			var select = $("select[name='monselect']").val();

			if(select == "Ventes")
			{
				jQuery.ajax({
					url : 'filtre_tableau_vente.php',
					type : 'POST',
					data : {
						mois : mois
					},
					success: function(data)
					{
		 				$('#ma_table_Ventes').html(data).fadeIn(500);
					},
					error: function(jqxhr)
					{
						alert(jqxhr.responseText);
					}
				});
			}
			else if(select == "Mandats")
			{
				jQuery.ajax({
					url : 'filtre_tableau_mandat.php',
					type : 'POST',
					data : {
						mois : mois
					},
					success: function(data)
					{
		 				$('#ma_table_Mandats').html(data).fadeIn(500);
					},
					error: function(jqxhr)
					{
						alert(jqxhr.responseText);
					}
				});
			}
	
		})

	});

</script>

<?php require "include/footer.php"; ?>
