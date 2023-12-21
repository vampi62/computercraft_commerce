<?php
if (!$_Serveur_['Module']['wirelessredstone']) {
    return array('status_code' => 403, 'message' => 'Le module wireless redstone est désactivé.');
}
require_once('class/checkdroits.class.php');
require_once('class/wireless.class.php');

if (!Checkdroits::checkArgs($_GET,array('page' => false, 'nbParPage' => false, 'showUser' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => false,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!is_numeric($_GET['page'])) {
    return array('status_code' => 400, 'message' => 'La page n\'est pas un nombre.');
}
if (!is_numeric($_GET['nbParPage'])) {
    return array('status_code' => 400, 'message' => 'Le nombre par page n\'est pas un nombre.');
}
// bool (true or false or 1 or 0)
if (!is_bool($_GET['showUser']) && $_GET['showUser'] != "true" && $_GET['showUser'] != "false" && $_GET['showUser'] != "1" && $_GET['showUser'] != "0") {
    $_GET['showUser'] = null;
}
if (!$_Serveur_['General']['moduleshowuser']) {
    $_GET['showUser'] = null;
}
return array('status_code' => 200, 'message' => '', 'data' => Wirelessredstones::getWirelessRedstones($bddConnection,$_GET['page'],$_GET['nbParPage'], $_GET['showUser']));