<?php
if (!$_Serveur_['Module']['wirelessredstone']) {
    return array('status_code' => 403, 'message' => 'Le module wireless redstone est désactivé.');
}
require_once('class/checkdroits.class.php');
require_once('class/wireless.class.php');

if (!Checkdroits::checkArgs($_GET,array('reserver' => true, 'id_joueur' => true, 'id_wireless' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_wireless'], 'wireless_redstone')) {
    return array('status_code' => 404, 'message' => 'Le wireless n\'existe pas.');
}
if (!is_bool($_GET['reserver']) && $_GET['reserver'] != "true" && $_GET['reserver'] != "false" && $_GET['reserver'] != "1" && $_GET['reserver'] != "0") {
    $_GET['reserver'] = false;
}
if ($_GET['reserver']) {
    if (!Checkdroits::checkId($bddConnection, $_GET['id_joueur'], 'joueur')) {
        return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
    }
    Wirelessredstones::setWirelessRedstone($bddConnection,$_GET['id_wireless'],$_GET['id_joueur'],date('Y-m-d H:i:s'));
    return array('status_code' => 200, 'message' => 'Le wireless a bien été reservé.');
} else {
    Wirelessredstones::setWirelessRedstone($bddConnection,$_GET['id_wireless'],null,null);
    return array('status_code' => 200, 'message' => 'Le wireless a bien été libéré.');
}