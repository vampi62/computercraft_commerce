<?php
require_once('class/checkdroits.class.php');
require_once('class/offres.class.php');
require_once('class/comptes.class.php');
require_once('class/adresses.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_joueur' => false, 'id_compte' => true, 'id_adresse' => true, 'id_type_offre' => false, 'prix' => true, 'description' => true, 'nom' => true, 'stock' => true), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
// le type de compte doit etre un compte entreprise_commerce pour pouvoir etre defini comme compte de l'offre
if (!empty($_POST['id_compte'])) {
    if (!Checkdroits::checkId($bddConnection, $_POST['id_compte'], 'compte')) {
        return array('status_code' => 404, 'message' => 'Le compte n\'existe pas.');
    }
    $compte = Comptes::getCompteById($bddConnection, $_POST['id_compte']);
    if (!$compte['id_type_compte'] > 2) { // ne doit pas etre un compte entreprise_livreur ou courant
        return array('status_code' => 400, 'message' => 'Le type de compte n\'est pas valide pour une offre.');
    }
} else {
    $_POST['id_compte'] = null;
}
// le type d'adresse doit etre un point de vente pour pouvoir etre defini comme adresse de l'offre
if (!empty($_POST['id_adresse'])) {
    if (!Checkdroits::checkId($bddConnection, $_POST['id_adresse'], 'adresse')) {
        return array('status_code' => 404, 'message' => 'L\'adresse n\'existe pas.');
    }
    $adresse = Adresses::getAdresseById($bddConnection, $_POST['id_adresse']);
    if (!$adresse['id_type_adresse'] > 2) { // ne doit pas etre un point relais ou une reception
        return array('status_code' => 400, 'message' => 'Le type d\'adresse n\'est pas valide pour une offre.');
    }
} else {
    $_POST['id_adresse'] = null;
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_type_offre'], 'type_offre')) {
    return array('status_code' => 404, 'message' => 'Le type d\'offre n\'existe pas.');
}
if (!is_numeric($_POST['prix'])) {
    return array('status_code' => 400, 'message' => 'Le prix n\'est pas un nombre.');
}
if (!is_numeric($_POST['stock'])) {
    return array('status_code' => 400, 'message' => 'Le stock n\'est pas un nombre.');
}
if ($_POST['prix'] < 0) {
    return array('status_code' => 400, 'message' => 'Le prix ne peut pas etre negatif.');
}
if ($_POST['stock'] < 0) {
    return array('status_code' => 400, 'message' => 'Le stock ne peut pas etre negatif.');
}
if (strlen($_POST['nom']) > $_Serveur_['MaxLengthChamps']['Nom']) {
    return array('status_code' => 413, 'message' => 'Le nom de l\'offre est trop long.');
}
if (strlen($_POST['description']) > $_Serveur_['MaxLengthChamps']['Description']) {
    return array('status_code' => 413, 'message' => 'La description est trop longue.');
}
$newOffre = new Offres($bddConnection);
$newOffre->addOffre($_POST['id_joueur'],$_POST['id_compte'],$_POST['id_adresse'],$_POST['id_type_offre'],$_POST['prix'],$_POST['description'],$_POST['nom'],$_POST['stock']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newOffre->getIdOffre()));