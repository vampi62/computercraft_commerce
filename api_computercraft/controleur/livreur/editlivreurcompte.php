<?php
require_once('class/checkdroits.class.php');
require_once('class/livreurs.class.php');
require_once('class/comptes.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_livreur' => false, 'id_compte' => true), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => true,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_POST['id_livreur'], 'livreur', 'editLivreurCompte', $sessionUser['isApi'])) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'ajouter un compte a ce livreur.');
}
if (!empty($_POST['id_compte'])) {
    if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_POST['id_compte'], 'compte', 'addCompteToLivreur', $sessionUser['isApi'])) {
        return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'ajouter ce compte a un livreur.');
    }
    $compte = Comptes::getCompteById($bddConnection, $_POST['id_compte']);
    if ($compte['id_type_compte'] != 2) { // ne doit pas etre autre chose qu'un compte entreprise_livreur
        return array('status_code' => 400, 'message' => 'Le type de compte n\'est pas valide pour un livreur.');
    }
} else {
    $_POST['id_compte'] = null;
}
$livreur = new Livreurs($bddConnection, $_POST['id_livreur']);
$livreur->setLivreurCompte($_POST['id_compte']);
return array('status_code' => 200, 'message' => 'Le compte du livreur a bien ete modifie.');