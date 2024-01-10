<?php
require_once('class/checkdroits.class.php');
require_once('class/apikeys.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_apikey' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_apikey'], 'apikey')) {
    return array('status_code' => 404, 'message' => 'l\'apikey n\'existe pas.');
}
$apiKey = new ApiKeys($bddConnection, $_POST['id_apikey']);
$apiKey->deleteapikey();
return array('status_code' => 200, 'message' => 'l\'apikey a bien ete supprimee.');