<?php
require_once('class/checkdroits.class.php');
require_once('class/comptes.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_compte' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_compte'], 'compte')) {
    return array('status_code' => 404, 'message' => 'Le compte n\'existe pas.');
}
if (Comptes::getCompteById($bddConnection, $_POST['id_compte'])['solde_compte'] != 0) {
    return array('status_code' => 403, 'message' => 'Le compte n\'est pas vide.');
}
$compte = new Comptes($bddConnection, $_POST['id_compte']);
$compte->deleteCompte();
return array('status_code' => 200, 'message' => 'Le compte a bien ete supprime.');