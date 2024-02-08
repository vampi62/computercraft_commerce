<?php
require_once('class/checkdroits.class.php');
require_once('class/commandes.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_commande' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => true,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_commande'], 'commande')) {
    return array('status_code' => 404, 'message' => 'La commande n\'existe pas.');
}
$commande = Commandes::getCommandeById($bddConnection, $_GET['id_commande']);
$permitAction = false;
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_offre'], 'offre', 'vendeurGetCommande', $sessionUser['isApi'])) {
    $permitAction = true;
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_livreur'], 'livreur', 'livreurGetCommande', $sessionUser['isApi'])) {
    $permitAction = true;
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_compte_client'], 'compte', 'clientGetCommande', $sessionUser['isApi'])) {
    $permitAction = true;
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_adresse_client'], 'adresse', 'clientGetCommande', $sessionUser['isApi'])) {
    $permitAction = true;
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_compte_vendeur'], 'compte', 'vendeurGetCommande', $sessionUser['isApi'])) {
    $permitAction = true;
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_adresse_vendeur'], 'adresse', 'vendeurGetCommande', $sessionUser['isApi'])) {
    $permitAction = true;
}
if (!$permitAction) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas les droits pour effectuer cette action.');
}
return array('status_code' => 200, 'message' => '', 'data' => Commandes::getCommandeById($bddConnection, $_GET['id_commande']));