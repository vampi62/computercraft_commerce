<?php
require_once('class/checkdroits.class.php');
require_once('class/apikeys.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_apikey' => false, 'nom' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_apikey'], 'apikey')) {
    return array('status_code' => 404, 'message' => 'l\'apikey n\'existe pas.');
}
$idJoueur = ApiKeys::getapikeyById($bddConnection, $_GET['id_apikey'])['id_joueur'];
if (count(ApiKeys::getapikeyByNom($bddConnection,$idJoueur . '-' . $_GET['nom']))) {
    return array('status_code' => 404, 'message' => 'Le nom de l\'apikey existe deja.');
}
if (strlen($_GET['nom']) > ($_Serveur_['MaxLengthChamps']['nom']+strlen($idJoueur)+2)) {
    return array('status_code' => 413, 'message' => 'Le nom de l\'apikey est trop long.');
}
$apiKey = new ApiKeys($bddConnection, $_GET['id_apikey']);
$apiKey->setapikeyNom($_GET['nom'], $idJoueur);
return array('status_code' => 200, 'message' => 'Le nom de l\'apikey a bien ete modifie.');