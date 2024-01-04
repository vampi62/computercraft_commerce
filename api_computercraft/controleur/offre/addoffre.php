<?php
require_once('class/checkdroits.class.php');
require_once('class/offres.class.php');
require_once('class/comptes.class.php');
require_once('class/adresses.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_compte' => true, 'id_adresse' => true, 'id_type_offre' => false, 'prix' => true, 'description' => true, 'nom' => true, 'stock' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => false,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_type_offre'], 'type_offre')) {
    return array('status_code' => 404, 'message' => 'Le type d\'offre n\'existe pas.');
}
// le type de compte doit etre un compte entreprise_commerce pour pouvoir etre defini comme compte de l'offre
if (!empty($_GET['id_compte'])) {
    if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_GET['id_compte'], 'compte', 'addCompteToOffre', $sessionUser['isApi'])) {
        return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
    }
    $compte = Comptes::getCompteById($bddConnection, $_GET['id_compte']);
    if (!$compte['id_type_compte'] > 2) { // ne doit pas etre un compte entreprise_livreur ou courant
        return array('status_code' => 400, 'message' => 'Le type de compte n\'est pas valide pour une offre.');
    }
} else {
    $_GET['id_compte'] = null;
}
// le type d'adresse doit etre un point de vente pour pouvoir etre defini comme adresse de l'offre
if (!empty($_GET['id_adresse'])) {
    if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_GET['id_adresse'], 'adresse', 'addAdresseToOffre', $sessionUser['isApi'])) {
        return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
    }
    $adresse = Adresses::getAdresseById($bddConnection, $_GET['id_adresse']);
    if (!$adresse['id_type_adresse'] > 2) { // ne doit pas etre un point relais ou une reception
        return array('status_code' => 400, 'message' => 'Le type d\'adresse n\'est pas valide pour une offre.');
    }
} else {
    $_GET['id_adresse'] = null;
}
if (!is_numeric($_GET['prix'])) {
    return array('status_code' => 400, 'message' => 'Le prix n\'est pas un nombre.');
}
if (!is_numeric($_GET['stock'])) {
    return array('status_code' => 400, 'message' => 'Le stock n\'est pas un nombre.');
}
if ($_GET['prix'] < 0) {
    return array('status_code' => 400, 'message' => 'Le prix ne peut pas etre negatif.');
}
if ($_GET['stock'] < 0) {
    return array('status_code' => 400, 'message' => 'Le stock ne peut pas etre negatif.');
}
if (strlen($_GET['nom']) > $_Serveur_['MaxLengthChamps']['Nom']) {
    return array('status_code' => 413, 'message' => 'Le nom de l\'offre est trop long.');
}
if (strlen($_GET['description']) > $_Serveur_['MaxLengthChamps']['Description']) {
    return array('status_code' => 413, 'message' => 'La description est trop longue.');
}
$newOffre = new Offres($bddConnection);
$newOffre->addOffre($sessionUser['idLogin'],$_GET['id_compte'],$_GET['id_adresse'],$_GET['id_type_offre'],$_GET['prix'],$_GET['description'],$_GET['nom'],$_GET['stock']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newOffre->getIdOffre()));