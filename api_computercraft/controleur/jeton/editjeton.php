<?php
require_once('class/jetons.class.php');
require_once('class/checkdroits.class.php');
require_once('class/apikeys.class.php');

if (!Checkdroits::checkArgs($_GET,array('1' => false, '10' => false, '100' => false, '1k' => false, '10k' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => true,'user' => false));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
$apikey = Apikeys::getApiKeyById($bddConnection, $sessionUser['idLogin']);
if (!Checkdroits::checkRole($bddConnection, $apikey['pseudo_joueur'], array('admin','terminal'))) {
    return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
}
$jeton = new Jetons($bddConnection, $sessionUser['idLogin']);
$jeton->setJeton($_GET);
return array('status_code' => 200, 'message' => 'Le jeton a bien ete modifie.');