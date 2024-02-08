<?php
require_once('class/checkdroits.class.php');
require_once('class/offres.class.php');

$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
return array('status_code' => 200, 'message' => '', 'data' => Offres::getOffres($bddConnection));