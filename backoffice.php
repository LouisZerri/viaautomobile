<?php
	
	require "include/header.php";

	if(!empty($_POST) && !empty($_POST['semaine_deb']) && !empty($_POST['semaine_fin']) && !empty($_POST['mois']))
	{
	    require_once 'bdd/database.php';
	    updateSemaine($_POST['semaine_deb'], $_POST['semaine_fin'],$_POST['mois']);
	    updateCompteur(0);
	    header('Location: tableau_de_bord.php');
	}
?>

<div class="container mt-5">
	<h1>Partie back-office</h1></br>
	<form action="" method="POST">
		<div class="form-group">
			<label for="">Début de semaine :</label>
			<input type="text" name="semaine_deb" class="form-control" required>
		</div>
		<div class="form-group">
			<label for="">Fin de semaine :</label>
			<input type="text" name="semaine_fin" class="form-control" required>
		</div>
		<div class="form-group">
			<label for="">Mois :</label>
			<select class="form-control" name="mois">
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
		<!-- Faire aussi pour le changement d'image-->
		<button type="submit" class="btn btn-primary">Valider</button>

	</form>
</div>

<?php require "include/footer.php" ?>