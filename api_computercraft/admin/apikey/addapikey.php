<?php
require_once('class/checkdroits.class.php');
require_once('class/apikeys.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_joueur' => false, 'nom' => false, 'mdp' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (ApiKeys::getapikeyByNom($bddConnection, $_GET['id_joueur'] . '-' . $_GET['nom'])) {
    return array('status_code' => 403, 'message' => 'Le nom de l\'apikey est deja utilise.');
}
if (strlen($_GET['nom']) > $_Serveur_['MaxLengthChamps']['nom']) {
    return array('status_code' => 413, 'message' => 'Le nom est trop long.');
}
if (!Checkdroits::checkPasswordSecu($_GET['mdp'])) {
    return array('status_code' => 400, 'message' => 'Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre.');
}
if (strlen($_GET['mdp']) > ($_Serveur_['MaxLengthChamps']['code']+strlen($_GET['id_joueur'])+2)) {
    return array('status_code' => 413, 'message' => 'Le mot de passe est trop long.');
}
$newApiKey = new ApiKeys($bddConnection);
$newApiKey->addapikey($_GET['nom'], $_GET['mdp'], $_GET['id_joueur']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newApiKey->getIdApiKey()));