<?php
require_once('class/checkdroits.class.php');
require_once('class/apikeys.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_droit' => false, 'id_apikey' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => false,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkProprioObj($bddConnection, $sessionUser['idLogin'], $_GET['id_apikey'], 'apikey')) {
    return array('status_code' => 404, 'message' => 'cette apikey n\'existe pas ou ne vous appartient pas.');
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_droit'], 'droit')) {
    return array('status_code' => 404, 'message' => 'Le droit n\'existe pas.');
}
$apiKey = new ApiKeys($bddConnection, $_GET['id_apikey']);
$apiKey->addapikeyDroits($_GET['id_droit']);
return array('status_code' => 200, 'message' => 'Le droit a bien ete ajoute a l\'apikey.');