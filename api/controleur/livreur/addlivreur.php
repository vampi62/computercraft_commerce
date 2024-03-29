<?php
require_once('class/checkdroits.class.php');
require_once('class/livreurs.class.php');
require_once('class/comptes.class.php');
require_once('class/adresses.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_compte' => true, 'id_adresse' => true, 'nom' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => false,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
// le type de compte doit etre un compte entreprise_livreur pour pouvoir etre defini comme livreur
if (!empty($_POST['id_compte'])) {
    if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_POST['id_compte'], 'compte', 'addCompteToLivreur', $sessionUser['isApi'])) {
        return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
    }
    $compte = Comptes::getCompteById($bddConnection, $_POST['id_compte']);
    if ($compte['id_type_compte'] != 2) { // ne doit pas etre autre chose qu'un compte entreprise_livreur
        return array('status_code' => 400, 'message' => 'Le type de compte n\'est pas valide pour un livreur.');
    }
} else {
    $_POST['id_compte'] = null;
}
// le type d'adresse doit etre un point relais pour pouvoir etre defini comme adresse par defait du livreur
if (!empty($_POST['id_adresse'])) {
    if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_POST['id_adresse'], 'adresse', 'addAdresseToLivreur', $sessionUser['isApi'])) {
        return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
    }
    $adresse = Adresses::getAdresseById($bddConnection, $_POST['id_adresse']);
    if ($adresse['id_type_adresse'] != 2) { // ne doit pas etre autre chose qu'un point relais
        return array('status_code' => 400, 'message' => 'Le type d\'adresse n\'est pas valide pour un livreur.');
    }
} else {
    $_POST['id_adresse'] = null;
}
if (strlen($_POST['nom']) > $_Serveur_['MaxLengthChamps']['Nom']) {
    return array('status_code' => 413, 'message' => 'Le nom du livreur est trop long.');
}
$newLivreur = new Livreurs($bddConnection);
$newLivreur->addLivreur($sessionUser['idLogin'], $_POST['id_compte'], $_POST['id_adresse'], $_POST['nom']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newLivreur->getIdLivreur()));