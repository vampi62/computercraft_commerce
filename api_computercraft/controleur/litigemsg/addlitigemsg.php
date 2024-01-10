<?php
require_once('class/checkdroits.class.php');
require_once('class/litigemsgs.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_commande' => false, 'description' => false, 'id_status_litigemsg' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => true,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
$commande = Commandes::getCommandeById($bddConnection, $_POST['id_commande']);
$permitAction = false;
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_offre'], 'offre', 'editLitigeMsgsByCommandeVendeur', $sessionUser['isApi'])) {
    $permitAction = true;
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_livreur'], 'livreur', 'editLitigeMsgsByCommandeLivreur', $sessionUser['isApi'])) {
    $permitAction = true;
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_compte_vendeur'], 'compte', 'editLitigeMsgsByCommandeVendeur', $sessionUser['isApi'])) {
    $permitAction = true;
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_adresse_vendeur'], 'adresse', 'editLitigeMsgsByCommandeVendeur', $sessionUser['isApi'])) {
    $permitAction = true;
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_compte_client'], 'compte', 'editLitigeMsgsByCommandeClient', $sessionUser['isApi'])) {
    $permitAction = true;
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_adresse_client'], 'adresse', 'editLitigeMsgsByCommandeClient', $sessionUser['isApi'])) {
    $permitAction = true;
}
if (!$permitAction) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas les droits pour effectuer cette action.');
}
if (strlen($_POST['description']) > $_Serveur_['MaxLengthChamps']['Description']) {
    return array('status_code' => 413, 'message' => 'Le message est trop long.');
}
$newid = LitigeMsgs::addLitigeMsg($bddConnection,$_POST['id_commande'],$_POST['description'],$_POST['id_status_litigemsg']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newid));