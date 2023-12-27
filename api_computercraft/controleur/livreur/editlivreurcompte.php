<?php
require_once('class/checkdroits.class.php');
require_once('class/livreurs.class.php');
require_once('class/comptes.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_livreur' => false, 'id_compte' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => true,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_GET['id_livreur'], 'livreur', 'editLivreurCompte', $sessionUser['isApi'])) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
}
if (!empty($_GET['id_compte'])) {
    if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_GET['id_compte'], 'compte', 'addCompteToLivreur', $sessionUser['isApi'])) {
        return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
    }
    $compte = Comptes::getCompteById($bddConnection, $_GET['id_compte']);
    if (!$compte['id_type_compte'] == 2) { // ne doit pas etre autre chose qu'un compte entreprise_livreur
        return array('status_code' => 400, 'message' => 'Le type de compte n\'est pas valide pour un livreur.');
    }
} else {
    $_GET['id_compte'] = null;
}
$livreur = new Livreurs($bddConnection, $_GET['id_livreur']);
$livreur->setLivreurCompte($_GET['id_compte']);
return array('status_code' => 200, 'message' => 'Le compte du livreur a bien ete modifie.');