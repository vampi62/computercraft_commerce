<?php
require_once('class/checkdroits.class.php');
require_once('class/apikeys.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_joueur' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => false,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
return array('status_code' => 200, 'message' => '', 'data' => ApiKeys::getApiKeysByUser($bddConnection, $sessionUser['idLogin']));