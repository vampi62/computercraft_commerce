<?php
require_once('class/checkdroits.class.php');
require_once('class/commandes.class.php');
require_once('class/adresses.class.php');
require_once('class/comptes.class.php');
require_once('class/offres.class.php');

if (!Checkdroits::checkArgs($_POST,array('nom' => false, 'quant' => false, 'prixu' => false, 'frait' => false, 'description' => false, 'code_retrait_commande' => false, 'id_adresse_client' => false, 'id_offre' => false, 'id_compte_client' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
// si pas de retour alors l'offre n'existe pas ou est inactive
$offre = Offres::getOffreById($bddConnection, $_POST['id_offre'], true)[0];
if (empty($offre)) {
    return array('status_code' => 404, 'message' => 'L\'offre n\'existe pas ou n\'est pas active.');
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_adresse_client'], 'adresse')) {
    return array('status_code' => 404, 'message' => 'L\'adresse client n\'existe pas.');
}
$adresse = Adresses::getAdresseById($bddConnection, $_POST['id_adresse_client']);
if (!$adresse['id_type_adresse'] == 1) {
    return array('status_code' => 400, 'message' => 'Le type d\'adresse n\'est pas valide pour un client.');
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_compte_client'], 'compte')) {
    return array('status_code' => 404, 'message' => 'Le compte client n\'existe pas.');
}
$compte = Comptes::getCompteById($bddConnection, $_POST['id_compte_client']);
if (!$compte['id_type_compte'] == 1) {
    return array('status_code' => 400, 'message' => 'Le type de compte client doit être un compte joueur.');
}
if (!is_numeric($_POST['quant'])) {
    return array('status_code' => 400, 'message' => 'La quantite doit être un nombre.');
}
if (!is_numeric($_POST['frait'])) {
    return array('status_code' => 400, 'message' => 'Les frais de port doivent être un nombre.');
}
if ($_POST['quant'] <= 0) {
    return array('status_code' => 400, 'message' => 'La quantite doit être superieur a 0.');
}
if ($_POST['prixu'] <= 0) {
    return array('status_code' => 400, 'message' => 'Le prix unitaire doit être superieur a 0.');
}
if ($_POST['frait'] <= 0) {
    return array('status_code' => 400, 'message' => 'Les frais de port doivent être superieur ou egal a 0.');
}
if (!Checkdroits::checkPasswordSecu($_POST['code_retrait_commande'])) {
    return array('status_code' => 400, 'message' => 'Le code de retrait n\'est pas securise.');
}
if (strlen($_POST['nom']) > $_Serveur_['MaxLengthChamps']['Nom']) {
    return array('status_code' => 413, 'message' => 'Le nom de la commande est trop long.');
}
if (strlen($_POST['description']) > $_Serveur_['MaxLengthChamps']['Description']) {
    return array('status_code' => 413, 'message' => 'La description de la commande est trop long.');
}
if (strlen($_POST['code_retrait_commande']) > $_Serveur_['MaxLengthChamps']['Code']) {
    return array('status_code' => 413, 'message' => 'Le code retrait est trop long.');
}
if ($offre['prix_offre'] != $_POST['prixu']) {
    return array('status_code' => 400, 'message' => 'Le prix unitaire ne correspond pas au prix de l\'offre.');
}
$newCommande = new Commandes($bddConnection);
$newCommande->addCommande($_POST['nom'],$_POST['quant'],$_POST['prixu'],$_POST['frait'],$_POST['description'],$_POST['code_retrait_commande'],$offre['id_adresse'],$_POST['id_adresse_client'],$_POST['id_offre'],$offre['id_compte'],$_POST['id_compte_client'],1);
$suivi = $sessionAdmin['pseudoLogin'].' a cree la commande via panel admin.';
$newCommande->setCommandeSuivi($suivi,$_Serveur_['General']['CaseLigneSuite']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newCommande->getIdCommande()));