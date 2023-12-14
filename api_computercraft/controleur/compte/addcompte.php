<?php
require_once('class/comptes.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_GET,array('nom' => false, 'id_type_compte' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => false,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_type_compte'], 'type_compte')) {
    return array('status_code' => 404, 'message' => 'Le type n\'existe pas.');
}
if (strlen($_GET['nom']) > $_Serveur_['MaxLengthChamps']['nom']) {
    return array('status_code' => 413, 'message' => 'Le nom du compte est trop long.');
}
$newCompte = new Comptes($bddConnection);
$newCompte->addCompte($sessionUser['idLogin'], $_GET['id_type_compte'], $_GET['nom']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newCompte->getIdCompte()));