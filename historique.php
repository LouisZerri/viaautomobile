<?php 


	require "include/header.php";
	require "bdd/database.php";
	require "include/functions.php";

	logged_only();

	$nom = $_SESSION['auth']->nom;
	$prenom = $_SESSION['auth']->prenom;

	$donnees = getAllVente($nom);

	$result = recupHistorique($nom);

	$delete_mandat = "delete_mandat.php?id=";
	$delete_vente = "delete_vente.php?id=";

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
	z-index:10;
	position: fixed;

}

.separation
{
	
	position: fixed;
	margin-left: 270px;
	height: 100%;
	width: 1px;
	background: grey;
	top: 0;
	bottom: 0;
	opacity: 0.2;
}

li
{
	list-style-type: none;
	z-index:10;
}

span
{
	color: white;
	z-index: 10;
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

table
{
	position: absolute; 
	width: 100%; 
	height: 25%;   
	right: 0; 
	margin: auto;
	zoom: 125%;
	padding-top: 50px;
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

}

</style>
<div class="separation"></div>
<div class="menu">
	</br>
	</br>
	<a href="accueil.php"><img style="padding-left: 35px;" src="style/logo_final.png" alt="logo" width="250"></a></br></br></br>
	<p style="padding-left: 45px;">Bonjour <b><?= $prenom; ?> <?= $nom; ?></b></p>
	</br>
	<ul>
		<li><a id="change" href="challenges.php"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;Les challenges</a></li></br>
		<li><a id="change" href="tableau_de_bord.php"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Mon tableau de bord</a></li></br>
		<li><a id="change" href="historique.php"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;Historique</a></li></br>
		<li><a id="change" href="parametre_compte.php"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;Paramètres du compte</a></li></br>
		<li><a id="change" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Deconnexion</a></li></br>
	</ul>
	<img style="position: fixed; left: 0; bottom: 0; padding-left: 15px;" src="style/logo_gris.svg" alt="logo" width="230">
</div>
<div class="container">
	<h3><b>AFFICHER L'HISTORIQUE</b></h3>
	<div class="row">
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
			<form action="" method="POST">
				<div class="form-group">
					<select name="mois" style="width: 50%; background-color: #531B51; color: white;" class="form-control">
						<option selected="selected"><span>Période</span></option>
						<option>Janvier</option>
						<option>Février</option>
						<option>Mars</option>
						<option>Avril</option>
						<option>Mai</option>
						<option>Juin</option>
						<option>Juillet</option>
						<option>Août</option>
						<option>Septembre</option>
						<option>Octobre</option>
						<option>Novembre</option>
						<option>Décembre</option>
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
				<tr id="<?= $i; ?>">
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
					<td align="center"><a id="vente" style="color: black;" href="<?= $delete_vente."".$res->id_vente ?>"><i class="fa fa-trash"></i></a></td>
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
					<td align="center"><a id="mandat" style="color: black;" href="<?= $delete_mandat."".$res->id_historique ?>"><i class="fa fa-trash"></i></a></td>
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

		$('select[name="mois"]').change(function(){

			
			var mois = $('select[name="mois"]').val();
			var td = document.getElementsByTagName('tr')
			if(mois == 'Période')
			{
				window.location.reload()
			}
			switch(mois)
			{
				case 'Janvier': mois = '01'; break;
				case 'Février': mois = '02'; break;
				case 'Mars': mois = '03'; break;
				case 'Avril': mois = '04'; break;
				case 'Mai': mois = '05'; break;
				case 'Juin': mois = '06'; break;
				case 'Juillet': mois = '07'; break;
				case 'Août': mois = '08'; break;
				case 'Septembre': mois = '09'; break;
				case 'Octobre': mois = '10'; break;
				case 'Novembre': mois = '11'; break;
				case 'Décembre': mois = '12'; break;
			}
			for(var i = 1; i < td.length + 2; i++)
			{
				date_vente = $('#'+i).find("td").html();
				date_mandat = $('#'+i).find("td").html();

				console.log(date_vente)
				console.log(date_mandat)

				if(date_vente === undefined)
				{
				}
				else
				{
					date = date_vente.substring(3,5);
					if(mois != date)
					{
						$('#'+i).fadeOut()
					}
				}

				if(date_mandat === undefined)
				{
				}
				else
				{
					date = date_mandat.substring(3,5);
					if(mois != date)
					{
						$('#'+i).fadeOut()
					}
				}
			}
		});	
	});







</script>



<?php require "include/footer.php"; ?>
