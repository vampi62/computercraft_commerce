<?php
if (!$_Serveur_['Module']['WirelessRedstone']) {
    return array('status_code' => 403, 'message' => 'Le module wireless redstone est désactivé.');
}
require_once('class/checkdroits.class.php');
require_once('class/wireless.class.php');

if (!Checkdroits::checkArgs($_POST,array('reserver' => true, 'id_joueur' => true, 'id_wireless' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_wireless'], 'wireless_redstone')) {
    return array('status_code' => 404, 'message' => 'Le wireless n\'existe pas.');
}
if (!is_bool($_POST['reserver']) && $_POST['reserver'] != "true" && $_POST['reserver'] != "false" && $_POST['reserver'] != "1" && $_POST['reserver'] != "0") {
    $_POST['reserver'] = false;
}
if ($_POST['reserver']) {
    if (!Checkdroits::checkId($bddConnection, $_POST['id_joueur'], 'joueur')) {
        return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
    }
    Wirelessredstones::setWirelessRedstone($bddConnection,$_POST['id_wireless'],$_POST['id_joueur'],date('Y-m-d H:i:s'));
    return array('status_code' => 200, 'message' => 'Le wireless a bien été reservé.');
} else {
    Wirelessredstones::setWirelessRedstone($bddConnection,$_POST['id_wireless'],null,null);
    return array('status_code' => 200, 'message' => 'Le wireless a bien été libéré.');
}