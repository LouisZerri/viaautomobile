<?php 

	session_start();
	require "include/header.php";
	require "bdd/database.php";

	$nom = $_SESSION['auth']->nom;
	$prenom = $_SESSION['auth']->prenom;

	$donnees = getAllVente($nom);

	$delete = "delete_historique.php?id=";
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
	clear: both;
	position: absolute;
	margin-left: 270px;
	height: 570px;
	width: 1px;
	background: grey;
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

#change
{
	color: #531B51;
}

#change:hover
{
	color: white;
	text-decoration: none;
	list-style-type: none;
	transition:all 1s;
}

li:hover
{
	background-color: #531B51;
	border:1px solid #531B51;
	-moz-border-radius: 10px 0;
	-webkit-border-radius: 10px 0;
	border-radius: 10px 0;
	width: 80%;
	color: white;
	text-decoration: none;
	list-style-type: none;
	transition:all 1s;
}
</style>
<div>
	<hr class="separation" />
</div>
<div class="menu">
	</br>
	</br>
	<img style="padding-left: 35px;" src="style/logo.svg" alt="logo" width="200"></br></br></br>
	<p style="padding-left: 45px;">Bonjour <b><?= $prenom; ?> <?= $nom; ?></b></p>
	</br>
	<ul>
		<li><a id="change" href="#"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;Les challenges</a></li></br>
		<li><a id="change" href="tableau_de_bord.php"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Mon tableau de bord</a></li></br>
		<li><a id="change" href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;Historique</a></li></br>
		<li><a id="change" href="#"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;Paramètres du compte</a></li></br>
		<li><a id="change" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Deconnexion</a></li></br>
	</ul>
	<img style="padding-left: 35px; height: 160px;" src="style/logo_gris.svg" alt="logo" width="200">
</div>
<div class="container">
	<h3><b>AFFICHER L'HISTORIQUE</b></h3>
	<div class="row">
		<div class="col mt-5">
			<form action="" method="POST">
				<div class="form-group">
					<select style="width: 50%; background-color: #531B51; color: white;" class="form-control" name="monselect">
						<option selected="selected"><span>Type d'action</span></option>
  						<option><span>Ventes</span></option>
					</select>
  				</div>
			</form>
		</div>
		<div class="col mt-5">
			<form action="" method="POST">
				<div class="form-group">
					<select style="width: 50%; background-color: #531B51; color: white;" class="form-control">
						<option selected="selected"><span>Période</span></option>
  						<option value="1"><span>Ventes</span></option>
					</select>
  				</div>
			</form>
		</div>
	</div>
	<table id="ma_table_Ventes" style="width: 70%; display: none;" class="table table-striped ml-5 mt-5">
		<thead>
			<tr>
  				<th scope="col">Date de vente</th>
		      	<th scope="col">Immatriculation</th>
		      	<th scope="col">Livraisons</th>
		      	<th scope="col">FMS</th>
		      	<th scope="col">Garenties</th>
		      	<th scope="col">Financements</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($donnees as $res): ?>
				<tr>
					<td><?= $res->date_vente; ?></td>
					<td><?= $res->immatriculation; ?></td>
					<?php if($res->livree == 1): ?>
						<td style="font-weight: bold; color: ##531B51;">Oui</td>
					<?php else: ?>
						<td>Non</td>
					<?php endif; ?>
					<?php if($res->frais_mer == 1): ?>
						<td style="font-weight: bold; color: ##531B51;">Oui</td>
					<?php else: ?>
						<td>Non</td>
					<?php endif; ?>
					<?php if($res->garentie == 1): ?>
						<td style="font-weight: bold; color: ##531B51;">Oui</td>
					<?php else: ?>
						<td>Non</td>
					<?php endif; ?>
					<?php if($res->financement == 1): ?>
						<td style="font-weight: bold; color: ##531B51;">Oui</td>
					<?php else: ?>
						<td>Non</td>
					<?php endif; ?>
					<td><a style="color: black;" href="<?= $delete."".$res->id_vente ?>"><i class="fa fa-trash"></i></a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	
	$(document).ready(function() {
		// Je sélectionne le select et quand la valeur change on fait une action
		$('select[name="monselect"]').change(function(){
		    // Je créer l'id du div qui va être affiché
		    var id = "ma_table_" + $(this).val();
		    // Je cache toutes les divs grâce à une classe qui va sélectionner le tout
		    $('table').hide(1000);
		    // Et j'affiche seulement le Div que je souhaite
		    $('#'+id).show(1000);
		});
	});







</script>

<?php require "include/footer.php"; ?>