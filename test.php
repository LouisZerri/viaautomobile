<?php
	
	session_start();
	
	$nom = $_SESSION['auth']->nom;
	$prenom = $_SESSION['auth']->prenom;
	
	echo "<p>".$prenom." ".$nom." est connecté ! ";