<?php
require_once('class/comptes.class.php');
require_once('class/checkdroits.class.php');

$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => true,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if ($sessionUser['isApi']) {
    return array('status_code' => 200, 'message' => '' ,'data' => Comptes::getComptesWithApiKey($bddConnection, $sessionUser['idLogin']));
} else {
    return array('status_code' => 200, 'message' => '' ,'data' => Comptes::getComptesWithUser($bddConnection, $sessionUser['idLogin']));
}