<?php
require_once('class/checkdroits.class.php');
require_once('class/apikeys.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_apikey' => false, 'nom' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => false,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkProprioObj($bddConnection, $sessionUser['idLogin'], $_POST['id_apikey'], 'apikey')) {
    return array('status_code' => 404, 'message' => 'cette apikey n\'existe pas ou ne vous appartient pas.');
}
if (!empty(ApiKeys::getapikeyByNom($bddConnection,$sessionUser['idLogin'] . '-' . $_POST['nom']))) {
    return array('status_code' => 404, 'message' => 'Le nom de l\'apikey existe deja.');
}
if (strlen($_POST['nom']) > $_Serveur_['MaxLengthChamps']['Nom']) {
    return array('status_code' => 413, 'message' => 'Le nom de l\'apikey est trop long.');
}
$apiKey = new ApiKeys($bddConnection, $_POST['id_apikey']);
$apiKey->setapikeyNom($_POST['nom'], $sessionUser['idLogin']);
return array('status_code' => 200, 'message' => 'Le nom de l\'apikey a bien ete modifie.');