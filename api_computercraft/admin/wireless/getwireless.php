<?php
if (!$_Serveur_['Module']['WirelessRedstone']) {
    return array('status_code' => 403, 'message' => 'Le module wireless redstone est désactivé.');
}
require_once('class/checkdroits.class.php');
require_once('class/wirelessredstones.class.php');

if (!Checkdroits::checkArgs($_GET,array('offset' => false, 'limit' => false, 'show' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!is_numeric($_GET['offset'])) {
    return array('status_code' => 400, 'message' => 'L\'offset n\'est pas un nombre.');
}
if (!is_numeric($_GET['limit'])) {
    return array('status_code' => 400, 'message' => 'Le nombre par page n\'est pas un nombre.');
}
// bool (true or false or 1 or 0)
if (!is_bool($_GET['show']) && $_GET['show'] != "true" && $_GET['show'] != "false" && $_GET['show'] != "1" && $_GET['show'] != "0") {
    $_GET['show'] = null;
}
return array('status_code' => 200, 'message' => '', 'data' => Wirelessredstones::getWirelessRedstones($bddConnection,$_GET['offset'],$_GET['limit'], $_GET['show']));