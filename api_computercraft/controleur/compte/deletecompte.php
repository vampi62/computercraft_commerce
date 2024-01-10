<?php
require_once('class/comptes.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_compte' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => false,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkProprioObj($bddConnection, $sessionUser['idLogin'], $_POST['id_compte'], 'compte')) {
    return array('status_code' => 404, 'message' => 'ce compte n\'existe pas ou ne vous appartient pas.');
}
$compte = new Comptes($bddConnection, $_POST['id_compte']);
$compte->deleteCompte();
return array('status_code' => 200, 'message' => 'Le compte a bien ete supprime.');