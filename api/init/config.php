<?php
	// On récupère la classe permettant la lecture en YML. Les fichiers de config sont sous ce format.
	require_once('init/config/yml.class.php');
	
	// On lit le fichier de config et on récupère les information dans un tableau. Celui-ci contiens la config générale.
	$configLecture = new Lire('init/config/config.yml');
	$_Serveur_ = $configLecture->GetTableau();