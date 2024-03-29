<?php
require_once('class/checkdroits.class.php');
require_once('class/offres.class.php');
require_once('class/comptes.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_offre' => false, 'id_compte' => true), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_offre'], 'offre')) {
    return array('status_code' => 404, 'message' => 'L\'offre n\'existe pas.');
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
$offre = new Offres($bddConnection, $_POST['id_offre']);
$offre->setOffreCompte($_POST['id_compte']);
return array('status_code' => 200, 'message' => 'Le compte de l\'offre a bien ete modifie.');