<?php
require_once('class/checkdroits.class.php');
require_once('class/litigemsgs.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_litigemsg' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => true,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
$commande = Commandes::getCommandeById($bddConnection, $_GET['id_commande']);
$permitAction = false;
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_offre'], 'offre', 'getlitigemsgsbycommande', $sessionUser['isApi'])) {
    $permitAction = true;
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_livreur'], 'livreur', 'getlitigemsgsbycommande', $sessionUser['isApi'])) {
    $permitAction = true;
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_compte_vendeur'], 'compte', 'getlitigemsgsbycommande', $sessionUser['isApi'])) {
    $permitAction = true;
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_adresse_vendeur'], 'adresse', 'getlitigemsgsbycommande', $sessionUser['isApi'])) {
    $permitAction = true;
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_compte_client'], 'compte', 'getlitigemsgsbycommande', $sessionUser['isApi'])) {
    $permitAction = true;
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_adresse_client'], 'adresse', 'getlitigemsgsbycommande', $sessionUser['isApi'])) {
    $permitAction = true;
}
if (!$permitAction) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas les droits pour effectuer cette action.');
}
$litigemsgs = LitigeMsgs::getLitigeMsgsByCommande($bddConnection, $_GET['id_commande']);
// si l'id du dernier litigemsg est different de l'id du litigemsg a supprimer alors on retourne une erreur
if (count($litigemsgs) == 0) {
    return array('status_code' => 400, 'message' => 'Il n\'y a pas de litigemsgs pour cette commande.');
}
if ($litigemsgs[count($litigemsgs) - 1]['id_litigemsg'] != $_GET['id_litigemsg']) {
    return array('status_code' => 400, 'message' => 'Le litigemsg a supprimer n\'est pas le dernier litigemsg.');
}
LitigeMsgs::deleteLitigemsg($bddConnection, $_GET['id_litigemsg']);
return array('status_code' => 200, 'message' => 'Le litigemsg a bien ete supprime.');