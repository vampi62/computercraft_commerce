<?php
if (!$_Serveur_['Module']['EnderStorage']) {
    return array('status_code' => 403, 'message' => 'Le module enderstorage est désactivé.');
}
require_once('class/checkdroits.class.php');
require_once('class/enderstorages.class.php');

if (!Checkdroits::checkArgs($_GET,array('offset' => true, 'limit' => true, 'show' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
// bool (true or false or 1 or 0)
if (!is_bool($_GET['show']) && $_GET['show'] != "true" && $_GET['show'] != "false" && $_GET['show'] != "1" && $_GET['show'] != "0") {
    $_GET['show'] = null;
}
Checkdroits::checkLimitOffset($_Serveur_, $_GET['limit'], $_GET['offset']);
return array('status_code' => 200, 'message' => '', 'data' => Enderstorages::getEnderStoragesChest($bddConnection, $_GET['show'], $_GET['limit'], $_GET['offset']));