<?php
require_once('class/checkdroits.class.php');
require_once('class/apikeys.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_apikey' => false, 'nom' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_apikey'], 'apikey')) {
    return array('status_code' => 404, 'message' => 'l\'apikey n\'existe pas.');
}
$idJoueur = ApiKeys::getapikeyById($bddConnection, $_POST['id_apikey'])['id_joueur'];
if (!empty(ApiKeys::getapikeyByNom($bddConnection,$idJoueur . '-' . $_POST['nom']))) {
    return array('status_code' => 404, 'message' => 'Le nom de l\'apikey existe deja.');
}
if (strlen($_POST['nom']) > ($_Serveur_['MaxLengthChamps']['Nom']+strlen($idJoueur)+2)) {
    return array('status_code' => 413, 'message' => 'Le nom de l\'apikey est trop long.');
}
$apiKey = new ApiKeys($bddConnection, $_POST['id_apikey']);
$apiKey->setapikeyNom($_POST['nom'], $idJoueur);
return array('status_code' => 200, 'message' => 'Le nom de l\'apikey a bien ete modifie.');