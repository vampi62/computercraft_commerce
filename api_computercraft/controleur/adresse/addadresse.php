<?php
require_once('class/checkdroits.class.php');
require_once('class/adresses.class.php');

if (!Checkdroits::checkArgs($_POST,array('coo' => false, 'nom' => false, 'description' => false, 'id_type_adresse' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => false,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_type_adresse'], 'type_adresse')) {
    return array('status_code' => 404, 'message' => 'Le type n\'existe pas.');
}
if (strlen($_POST['nom']) > $_Serveur_['MaxLengthChamps']['Nom']) {
    return array('status_code' => 400, 'message' => 'Le nom de l\'adresse est trop long.');
}
if (strlen($_POST['description']) > $_Serveur_['MaxLengthChamps']['Description']) {
    return array('status_code' => 400, 'message' => 'La description est trop longue.');
}
if (strlen($_POST['coo']) > $_Serveur_['MaxLengthChamps']['Coo']) {
    return array('status_code' => 400, 'message' => 'Les coordonnees sont trop longues.');
}
$newAdresse = new Adresses($bddConnection);
$newAdresse->addAdresse($sessionUser['idLogin'], $_POST['coo'], $_POST['nom'], $_POST['description'], $_POST['id_type_adresse']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newAdresse->getIdAdresse()));