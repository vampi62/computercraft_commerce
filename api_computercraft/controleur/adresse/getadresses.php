<?php
require_once('class/checkdroits.class.php');
require_once('class/adresses.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_joueur' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => true,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if ($sessionUser['isApi']) {
    return array('status_code' => 200, 'message' => '', 'data' => Adresses::getAdressesWithApiKey($bddConnection, $sessionUser['idLogin']));
} else {
    return array('status_code' => 200, 'message' => '', 'data' => Adresses::getAdressesWithUser($bddConnection, $sessionUser['idLogin']));
}