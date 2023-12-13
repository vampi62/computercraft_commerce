<?php
require_once('class/jetons.class.php');
require_once('class/checkdroits.class.php');

$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => false,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkRole($bddConnection, $sessionUser['pseudoLogin'], array('admin','terminal'))) {
    return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
}
return array('status_code' => 200, 'message' => '', 'jetons' => Jetons::getJetons($bddConnection));