<?php

	require "bdd/database.php";
	require "include/functions.php";
	logged_only();

	function isAjax()
	{
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
	}

	$nom = $_SESSION['auth']->nom;

	if(isAjax())
	{
		$current_mandat = recupereMandat($nom);

		insertHistorique($_GET['nombre'], $nom, date('d/m/Y'));

		$current_mandat->nombre += $_GET['nombre'];

		updateMandat($current_mandat->nombre, $nom);

		$donnee = recupereDernierMandat($nom);
		?>
		<p><?= $donnee->nombre ?></p>
		<?php
	}
	else
	{
		header('Location: tableau_de_bord.php');
	}



?>