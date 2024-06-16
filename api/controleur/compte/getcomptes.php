<?php
require_once('class/comptes.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_GET,array('offset' => true, 'limit' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => true,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
Checkdroits::checkLimitOffset($_Serveur_, $_GET['limit'], $_GET['offset']);
if ($sessionUser['isApi']) {
    return array('status_code' => 200, 'message' => '' ,'data' => Comptes::getComptesByApiKey($bddConnection, $sessionUser['idLogin'], $_GET['limit'], $_GET['offset']));
} else {
    return array('status_code' => 200, 'message' => '' ,'data' => Comptes::getComptesByUser($bddConnection, $sessionUser['idLogin'], $_GET['limit'], $_GET['offset']));
}