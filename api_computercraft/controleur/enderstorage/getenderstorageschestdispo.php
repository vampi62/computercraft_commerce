<?php
if (!$_Serveur_['Module']['EnderStorage']) {
    return array('status_code' => 403, 'message' => 'Le module enderstorage est désactivé.');
}
require_once('class/checkdroits.class.php');
require_once('class/enderstorages.class.php');

if (!Checkdroits::checkArgs($_GET,array('page' => false, 'limit' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => false,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!is_numeric($_GET['page'])) {
    return array('status_code' => 400, 'message' => 'La page n\'est pas un nombre.');
}
if (!is_numeric($_GET['limit'])) {
    return array('status_code' => 400, 'message' => 'Le nombre par page n\'est pas un nombre.');
}
return array('status_code' => 200, 'message' => '', 'data' => Enderstorages::getEnderStoragesChestNonReserver($bddConnection,$_GET['page'],$_GET['limit']));