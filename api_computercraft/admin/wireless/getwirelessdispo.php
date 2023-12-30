<?php
if (!$_Serveur_['Module']['wirelessredstone']) {
    return array('status_code' => 403, 'message' => 'Le module wireless redstone est désactivé.');
}
require_once('class/checkdroits.class.php');
require_once('class/wireless.class.php');

if (!Checkdroits::checkArgs($_GET,array('offset' => false, 'nbParPage' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!is_numeric($_GET['offset'])) {
    return array('status_code' => 400, 'message' => 'L\'offset n\'est pas un nombre.');
}
if (!is_numeric($_GET['nbParPage'])) {
    return array('status_code' => 400, 'message' => 'Le nombre par page n\'est pas un nombre.');
}
return array('status_code' => 200, 'message' => '', 'data' => Wirelessredstones::getWirelessRedstonesNonReserver($bddConnection,$_GET['offset'],$_GET['nbParPage'], $_GET['showUser']));