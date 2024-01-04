<?php
require_once('class/checkdroits.class.php');
require_once('class/apikeys.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_apikey' => false, 'mdp' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_apikey'], 'apikey')) {
    return array('status_code' => 404, 'message' => 'l\'apikey n\'existe pas.');
}
if (!Checkdroits::checkPasswordSecu($_GET['mdp'])) {
    return array('status_code' => 400, 'message' => 'Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre.');
}
if (strlen($_GET['mdp']) > $_Serveur_['MaxLengthChamps']['Code']) {
    return array('status_code' => 413, 'message' => 'Le mot de passe est trop long.');
}
$apiKey = new ApiKeys($bddConnection, $_GET['id_apikey']);
$apiKey->setapikeyMdp($_GET['mdp']);
return array('status_code' => 200, 'message' => 'Le mot de passe de l\'apikey a bien ete modifie.');