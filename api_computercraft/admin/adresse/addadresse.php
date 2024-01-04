<?php
require_once('class/checkdroits.class.php');
require_once('class/adresses.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_joueur' => false, 'coo' => false, 'nom' => false, 'description' => false, 'id_type_adresse' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_type_adresse'], 'type_adresse')) {
    return array('status_code' => 404, 'message' => 'Le type n\'existe pas.');
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (strlen($_GET['nom']) > $_Serveur_['MaxLengthChamps']['Nom']) {
    return array('status_code' => 400, 'message' => 'Le nom de l\'adresse est trop long.');
}
if (strlen($_GET['description']) > $_Serveur_['MaxLengthChamps']['Description']) {
    return array('status_code' => 400, 'message' => 'La description est trop longue.');
}
if (strlen($_GET['coo']) > $_Serveur_['MaxLengthChamps']['Coo']) {
    return array('status_code' => 400, 'message' => 'Les coordonnees sont trop longues.');
}
$newAdresse = new Adresses($bddConnection);
$newAdresse->addAdresse($_GET['id_joueur'], $_GET['coo'], $_GET['nom'], $_GET['description'], $_GET['id_type_adresse']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newAdresse->getIdAdresse()));