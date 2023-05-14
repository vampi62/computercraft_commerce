<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, "fr_FR");

require_once('resource.php');
require_once('../class/config/yml.class.php');
require_once('../class/checkdroits.class.php');
$configLecture = new Lire('../class/config/config.yml');
$_Serveur_ = $configLecture->GetTableau();
if ($_Serveur_['Install'] != true) {
	if (isset($_Serveur_['DataBase']['dbAdress']) AND isset($_Serveur_['DataBase']['dbName']) AND isset($_Serveur_['DataBase']['dbUser']) AND isset($_Serveur_['DataBase']['dbPassword']) AND isset($_Serveur_['DataBase']['dbPort'])) {
		if(checkdroits::CheckArgs($_GET,array('pseudo','mdpconfirm','mdp','email'))) {
			$_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
			$_GET['mdp'] = htmlspecialchars($_GET['mdp']);
			$_GET['mdpconfirm'] = htmlspecialchars($_GET['mdpconfirm']);
			$_GET['email'] = htmlspecialchars($_GET['email']);
			if (preg_match('@[A-Z]@', $_GET['mdp']) AND preg_match('@[a-z]@', $_GET['mdp']) AND preg_match('@[0-9]@', $_GET['mdp']) AND strlen($_GET['mdp']) > 8) {
				if($_GET['mdp'] == $_GET['mdpconfirm']) {
					if(filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
						if ((verifyPDO($_Serveur_['DataBase']['dbAdress'],$_Serveur_['DataBase']['dbName'],$_Serveur_['DataBase']['dbUser'],$_Serveur_['DataBase']['dbPassword'],$_Serveur_['DataBase']['dbPort'])) === TRUE) {
							$sql = getPDO($_Serveur_['DataBase']['dbAdress'],$_Serveur_['DataBase']['dbName'],$_Serveur_['DataBase']['dbUser'],$_Serveur_['DataBase']['dbPassword'],$_Serveur_['DataBase']['dbPort']);
							$sql->exec(file_get_contents('install.sql'));
							SetHtpasswd();
							SetAdmin($_GET['pseudo'], $_GET['mdp'], $_GET['email'], $sql);
							$_Serveur_['Install'] = true;
							$ecriture = new Ecrire('../class/config/config.yml', $_Serveur_);
							// 'installation terminer vous pouvez supprimer le repertoire installation';
							$printmessage = array('status_code' => 200, 'message' => 'Installation terminee, vous pouvez supprimer le repertoire installation.');
						} else {
							// 'identifiant base de donnee incorect';
							$printmessage = array('status_code' => 500, 'message' => 'Identifiant base de donnee incorrect.');
						}
					} else {
						// 'email invalide';
						$printmessage = array('status_code' => 400, 'message' => 'Email invalide.');
					}
				} else {
					// "le mot de passe n'est pas identique";
					$printmessage = array('status_code' => 400, 'message' => 'Le mot de passe n\'est pas identique.');
				}
			} else {
				// 'le mot de passe ne respecte pas les regles de securite';
				$printmessage = array('status_code' => 400, 'message' => 'Le mot de passe ne respecte pas les regles de securite.');
			}
		} else {
			// 'il manque des parametres';
			$printmessage = array('status_code' => 400, 'message' => 'Il manque des parametres.');
		}
	} else {
		// 'fichier config incorrect';
		$printmessage = array('status_code' => 400, 'message' => 'Fichier config incorrect.');
	}
} else {
	// 'dejà installer';
	$printmessage = array('status_code' => 400, 'message' => 'Dejà installer.');
}
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
if (isset($printmessage) && !empty($printmessage)) {
	http_response_code($printmessage['status_code']);
	echo json_encode($printmessage);
}