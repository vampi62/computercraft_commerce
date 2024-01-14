<?php
if (!$_Serveur_['Module']['WirelessRedstone']) {
    return array('status_code' => 403, 'message' => 'Le module wireless redstone est désactivé.');
}
require_once('class/checkdroits.class.php');
require_once('class/wirelessredstones.class.php');

if (!Checkdroits::checkArgs($_GET,array('offset' => true, 'limit' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => false,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!is_numeric($_GET['offset'])) {
    return array('status_code' => 400, 'message' => 'L\'offset n\'est pas un nombre.');
}
if (!is_numeric($_GET['limit'])) {
    return array('status_code' => 400, 'message' => 'Le nombre par page n\'est pas un nombre.');
}
return array('status_code' => 200, 'message' => '', 'data' => Wirelessredstones::getWirelessRedstonesNonReserver($bddConnection,$_GET['offset'],$_GET['limit']));