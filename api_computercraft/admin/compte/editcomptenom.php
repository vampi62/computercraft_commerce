<?php
require_once('class/checkdroits.class.php');
require_once('class/comptes.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_compte' => false, 'nom' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_compte'], 'compte')) {
    return array('status_code' => 404, 'message' => 'Le compte n\'existe pas.');
}
if (strlen($_GET['nom']) > $_Serveur_['MaxLengthChamps']['nom']) {
    return array('status_code' => 413, 'message' => 'Le nom du compte est trop long.');
}
$compte = new Comptes($bddConnection, $_GET['id_compte']);
$compte->setCompteNom($_GET['nom']);
return array('status_code' => 200, 'message' => 'Le nom du compte a bien ete modifie.');