<?php
require_once('class/checkdroits.class.php');
require_once('class/apikeys.class.php');
require_once('class/droits.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_apikey' => false, 'id_droit' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => false,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkProprioObj($bddConnection, $sessionUser['idLogin'], $_POST['id_apikey'], 'apikey')) {
    return array('status_code' => 404, 'message' => 'cette apikey n\'existe pas ou ne vous appartient pas.');
}
$droit = Droits::getDroitById($bddConnection, $_POST['id_droit']);
if (empty($droit)) {
    return array('status_code' => 404, 'message' => 'Le droit n\'existe pas.');
}
if ($droit['apikey_droit'] != 1) {
    return array('status_code' => 403, 'message' => 'Ce droit n\'est pas un droit d\'apikey.');
}
$apiKey = new ApiKeys($bddConnection, $_POST['id_apikey']);
$apiKey->addapikeyDroits($_POST['id_droit']);
return array('status_code' => 200, 'message' => 'Le droit a bien ete ajoute a l\'apikey.');