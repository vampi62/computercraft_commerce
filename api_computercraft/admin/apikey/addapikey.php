<?php
require_once('class/checkdroits.class.php');
require_once('class/apikeys.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_joueur' => false, 'nom' => false, 'mdp' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (ApiKeys::getapikeyByNom($bddConnection, $_POST['id_joueur'] . '-' . $_POST['nom'])) {
    return array('status_code' => 403, 'message' => 'Le nom de l\'apikey est deja utilise.');
}
if (strlen($_POST['nom']) > $_Serveur_['MaxLengthChamps']['Nom']+strlen($_POST['id_joueur'])+2) {
    return array('status_code' => 413, 'message' => 'Le nom est trop long.');
}
if (!Checkdroits::checkPasswordSecu($_POST['mdp'])) {
    return array('status_code' => 400, 'message' => 'Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre.');
}
if (strlen($_POST['mdp']) > $_Serveur_['MaxLengthChamps']['Code']) {
    return array('status_code' => 413, 'message' => 'Le mot de passe est trop long.');
}
$newApiKey = new ApiKeys($bddConnection);
$newApiKey->addapikey($_POST['nom'], $_POST['mdp'], $_POST['id_joueur']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newApiKey->getIdApiKey()));