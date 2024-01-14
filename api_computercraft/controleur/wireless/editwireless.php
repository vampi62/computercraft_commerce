<?php
if (!$_Serveur_['Module']['WirelessRedstone']) {
    return array('status_code' => 403, 'message' => 'Le module wireless redstone est désactivé.');
}
require_once('class/checkdroits.class.php');
require_once('class/wirelessredstones.class.php');

if (!Checkdroits::checkArgs($_POST,array('reserver' => true, 'id_wireless' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => false,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_wireless'], 'wireless_redstone')) {
    return array('status_code' => 404, 'message' => 'Le wireless n\'existe pas.');
}
if (!is_bool($_POST['reserver']) && $_POST['reserver'] != "true" && $_POST['reserver'] != "false" && $_POST['reserver'] != "1" && $_POST['reserver'] != "0") {
    $_POST['reserver'] = false;
}
$wifi = Wirelessredstones::getWirelessRedstoneById($bddConnection,$_POST['id_wireless']);
if ($_POST['reserver']) {
    if ($wifi['id_joueur'] != null) {
        return array('status_code' => 403, 'message' => 'Le wireless est déjà reservé.');
    }
    Wirelessredstones::setWirelessRedstone($bddConnection,$_POST['id_wireless'],$sessionUser['idLogin'],date('Y-m-d H:i:s'));
    return array('status_code' => 200, 'message' => 'Le wireless a bien été reservé.');
} else {
    if ($wifi['id_joueur'] != $sessionUser['idLogin']) {
        return array('status_code' => 403, 'message' => 'Vous ne pouvez pas libérer un wireless que vous n\'avez pas reservé.');
    }
    Wirelessredstones::setWirelessRedstone($bddConnection,$_POST['id_wireless'],null,null);
    return array('status_code' => 200, 'message' => 'Le wireless a bien été libéré.');
}