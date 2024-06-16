<?php
if (!$_Serveur_['Module']['WirelessRedstone']) {
    return array('status_code' => 403, 'message' => 'Le module wireless redstone est désactivé.');
}
require_once('class/checkdroits.class.php');
require_once('class/wirelessredstones.class.php');

if (!Checkdroits::checkArgs($_GET,array('offset' => true, 'limit' => true, 'show' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => false,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
// bool (true or false or 1 or 0)
if (!is_bool($_GET['show'])) {
    $_GET['show'] = $_GET['show'] == "true" || $_GET['show'] == "1" ? true : false;
}
if (!$_Serveur_['General']['ModuleShowUser']) {
    $_GET['show'] = null;
}
Checkdroits::checkLimitOffset($_Serveur_, $_GET['limit'], $_GET['offset']);
return array('status_code' => 200, 'message' => '', 'data' => Wirelessredstones::getWirelessRedstones($bddConnection, $_GET['show'], $_GET['limit'], $_GET['offset']));