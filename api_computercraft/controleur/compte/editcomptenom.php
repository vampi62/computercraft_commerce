<?php
require_once('class/comptes.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_GET,array('nom' => false, 'id_compte' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => true,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (strlen($_GET['nom']) > $_Serveur_['MaxLengthChamps']['nom']) {
    return array('status_code' => 413, 'message' => 'Le nom du compte est trop long.');
}
if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_GET['id_compte'], 'compte', 'editcomptenom', $sessionUser['isApi'])) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
}
$compte = new Comptes($bddConnection, $_GET['id_compte']);
$compte->setCompteNom($_GET['nom']);
return array('status_code' => 200, 'message' => 'Le nom du compte a bien ete modifie.');