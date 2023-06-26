<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, "fr_FR");

require_once('resource.php');
require_once('init/config/yml.class.php');
require_once('class/checkdroits.class.php');
$configLecture = new Lire('init/config/config.yml');
$_Serveur_ = $configLecture->GetTableau();
if ($_Serveur_['Install']) {
	// 'dejà installer';
	return array('status_code' => 400, 'message' => 'Deja installer.');
}
if (!isset($_Serveur_['DataBase']['dbAdress']) || !isset($_Serveur_['DataBase']['dbName']) || !isset($_Serveur_['DataBase']['dbUser']) || !isset($_Serveur_['DataBase']['dbPassword']) || !isset($_Serveur_['DataBase']['dbPort'])) {
	// 'fichier config incorrect';
	return array('status_code' => 400, 'message' => 'Fichier config incorrect.');
}
if (!Checkdroits::CheckArgs($_GET,array('pseudo' => false,'mdp' => false,'email' => false))) {
	// 'il manque des parametres';
	return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
if (!Checkdroits::CheckPasswordSecu($_GET['mdp'])) {
	// 'le mot de passe ne respecte pas les regles de securite';
    return array('status_code' => 400, 'message' => 'Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre.');
}
if (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
	// 'email invalide';
	return array('status_code' => 400, 'message' => 'Email invalide.');
}
if (!(verifyPDO($_Serveur_['DataBase']['dbAdress'],$_Serveur_['DataBase']['dbName'],$_Serveur_['DataBase']['dbUser'],$_Serveur_['DataBase']['dbPassword'],$_Serveur_['DataBase']['dbPort']))) {
	// 'identifiant base de donnee incorect';
	return array('status_code' => 500, 'message' => 'Identifiant base de donnee incorrect.');
}
$sql = getPDO($_Serveur_['DataBase']['dbAdress'],$_Serveur_['DataBase']['dbName'],$_Serveur_['DataBase']['dbUser'],$_Serveur_['DataBase']['dbPassword'],$_Serveur_['DataBase']['dbPort']);
$sql->exec(file_get_contents('install.sql'));
if ($_Serveur_['Module']['enderstorage']) {
	$sql->exec(file_get_contents('enderstorage.sql'));
}
if ($_Serveur_['Module']['wirelessredstone']) {
	$sql->exec(file_get_contents('wirelessredstone.sql'));
}
SetHtpasswd();
SetAdmin($sql, $_GET['pseudo'], $_GET['mdp'], $_GET['email']);
$_Serveur_['Install'] = true;
$ecriture = new Ecrire('init/config/config.yml', $_Serveur_);
return array('status_code' => 200, 'message' => 'Installation terminer');