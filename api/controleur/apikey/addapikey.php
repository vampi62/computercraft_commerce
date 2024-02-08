<?php
require_once('class/checkdroits.class.php');
require_once('class/apikeys.class.php');

if (!Checkdroits::checkArgs($_POST,array('nom' => false, 'mdp' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => false,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (ApiKeys::getapikeyByNom($bddConnection, $sessionUser['idLogin'] . '-' . $_POST['nom'])) {
    return array('status_code' => 403, 'message' => 'Le nom de l\'apikey est deja utilise.');
}
if (strlen($_POST['nom']) > $_Serveur_['MaxLengthChamps']['Nom']+strlen($sessionUser['idLogin'])+2) {
    return array('status_code' => 413, 'message' => 'Le nom est trop long.');
}
if (!Checkdroits::checkPasswordSecu($_POST['mdp'])) {
    return array('status_code' => 400, 'message' => 'Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre.');
}
if (strlen($_POST['mdp']) > $_Serveur_['MaxLengthChamps']['Code']) {
    return array('status_code' => 413, 'message' => 'Le mot de passe est trop long.');
}
$newApiKey = new ApiKeys($bddConnection);
$newApiKey->addapikey($_POST['nom'], $_POST['mdp'], $sessionUser['idLogin']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newApiKey->getIdApiKey()));