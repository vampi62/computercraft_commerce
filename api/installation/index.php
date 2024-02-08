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
	return array('status_code' => 500, 'message' => 'Le serveur est deja installe.');
}
if (!isset($_Serveur_['DataBase']['dbAdress']) || !isset($_Serveur_['DataBase']['dbName']) || !isset($_Serveur_['DataBase']['dbUser']) || !isset($_Serveur_['DataBase']['dbPassword']) || !isset($_Serveur_['DataBase']['dbPort'])) {
	// 'fichier config incorrect';
	return array('status_code' => 500, 'message' => 'Fichier config incorrect.');
}
if (!Checkdroits::checkArgs($_POST,array('pseudo' => false,'mdp' => false,'email' => false))) {
	// 'il manque des parametres';
	return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
if (!Checkdroits::checkPasswordSecu($_POST['mdp'])) {
	// 'le mot de passe ne respecte pas les regles de securite';
    return array('status_code' => 400, 'message' => 'Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre.');
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	// 'email invalide';
	return array('status_code' => 400, 'message' => 'Email invalide.');
}
if (!(verifyPDO($_Serveur_['DataBase']['dbAdress'],$_Serveur_['DataBase']['dbName'],$_Serveur_['DataBase']['dbUser'],$_Serveur_['DataBase']['dbPassword'],$_Serveur_['DataBase']['dbPort']))) {
	// 'identifiant base de donnee incorect';
	return array('status_code' => 500, 'message' => 'Identifiant base de donnee incorrect.');
}
$sql = getPDO($_Serveur_['DataBase']['dbAdress'],$_Serveur_['DataBase']['dbName'],$_Serveur_['DataBase']['dbUser'],$_Serveur_['DataBase']['dbPassword'],$_Serveur_['DataBase']['dbPort']);
$sql->exec(file_get_contents('./installation/install.sql'));
if ($_Serveur_['Module']['EnderStorage']) {
	$sql->exec(file_get_contents('./installation/enderstorage.sql'));
}
if ($_Serveur_['Module']['WirelessRedstone']) {
	$sql->exec(file_get_contents('./installation/wirelessredstone.sql'));
}
SetHtpasswd();
SetAdmin($sql, $_POST['pseudo'], $_POST['mdp'], $_POST['email']);
$_Serveur_['Install'] = true;
$ecriture = new Ecrire('init/config/config.yml', $_Serveur_);
return array('status_code' => 200, 'message' => 'Installation terminer');