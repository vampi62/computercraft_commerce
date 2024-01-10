<?php
require_once('class/checkdroits.class.php');
require_once('class/livreurs.class.php');
require_once('class/comptes.class.php');
require_once('class/adresses.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_joueur' => false, 'id_compte' => true, 'id_adresse' => true, 'nom' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
// le type de compte doit etre un compte entreprise_livreur pour pouvoir etre defini comme livreur
if (!empty($_POST['id_compte'])) {
    if (!Checkdroits::checkId($bddConnection, $_POST['id_compte'], 'compte')) {
        return array('status_code' => 404, 'message' => 'Le compte n\'existe pas.');
    }
    $compte = Comptes::getCompteById($bddConnection, $_POST['id_compte']);
    if (!$compte['id_type_compte'] == 2) { // ne doit pas etre autre chose qu'un compte entreprise_livreur
        return array('status_code' => 400, 'message' => 'Le type de compte n\'est pas valide pour un livreur.');
    }
} else {
    $_POST['id_compte'] = null;
}
// le type d'adresse doit etre un point relais pour pouvoir etre defini comme adresse par defait du livreur
if (!empty($_POST['id_adresse'])) {
    if (!Checkdroits::checkId($bddConnection, $_POST['id_adresse'], 'adresse')) {
        return array('status_code' => 404, 'message' => 'L\'adresse n\'existe pas.');
    }
    $adresse = Adresses::getAdresseById($bddConnection, $_POST['id_adresse']);
    if (!$adresse['id_type_adresse'] == 2) { // ne doit pas etre autre chose qu'un point relais
        return array('status_code' => 400, 'message' => 'Le type d\'adresse n\'est pas valide pour un livreur.');
    }
} else {
    $_POST['id_adresse'] = null;
}
if (strlen($_POST['nom']) > $_Serveur_['MaxLengthChamps']['Nom']) {
    return array('status_code' => 413, 'message' => 'Le nom du livreur est trop long.');
}
$newLivreur = new Livreurs($bddConnection);
$newLivreur->addLivreur($_POST['id_joueur'], $_POST['id_compte'], $_POST['id_adresse'], $_POST['nom']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newLivreur->getIdLivreur()));