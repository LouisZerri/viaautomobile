<?php

	require "include/header.php";

?>

<div class="container">
	<div class="card">
  		<div class="card-header">Renseignements</div>
	  	<div class="card-body">
	    	<form action="" method="POST">
	    		<h2>Les mandats</h2>
					<div class="form-group">
						<label for="">Veuillez saisir le nombre de nouveau mandats :</label>
						<input type="text" name="mandat" class="form-control" required>
					</div>
				<h2>Ajouter des commandes</h2>
					<div class="form-group">
						<label for="">Veuillez saisir l'immatriculation du vehicule :</label>
						<input type="text" name="immatriculation" class="form-control" required>
					</div>
					<div class="row">
						<div class="col-sm">
							<label>Livrée :</label>
							<div class="form-check">
		  						<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
		  						<label class="form-check-label" for="defaultCheck1">Oui</label>
							</div>
							<div class="form-check">
		  						<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
		  						<label class="form-check-label" for="defaultCheck1">Non</label>
							</div>
						</div>
						<div class="col-sm">
							<label>Frais de mise à la route :</label>
							<div class="form-check">
		  						<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
		  						<label class="form-check-label" for="defaultCheck1">Oui</label>
							</div>
							<div class="form-check">
		  						<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
		  						<label class="form-check-label" for="defaultCheck1">Non</label>
							</div>
						</div>
						<div class="col-sm">
							<label>Garentie :</label>
							<div class="form-check">
		  						<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
		  						<label class="form-check-label" for="defaultCheck1">Oui</label>
							</div>
							<div class="form-check">
		  						<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
		  						<label class="form-check-label" for="defaultCheck1">Non</label>
							</div>
						</div>
						<div class="col-sm">
							<label>Financement :</label>
							<div class="form-check">
		  						<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
		  						<label class="form-check-label" for="defaultCheck1">Oui</label>
							</div>
							<div class="form-check">
		  						<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
		  						<label class="form-check-label" for="defaultCheck1">Non</label>
							</div>
						</div>
					</div></br></br>
					<center><button class="btn btn-primary">Valider</button></center>
	  			</div>
	  		</form>
		</div>
	</div>
</div>


<?php

	require "include/footer.php";