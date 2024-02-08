<?php
require_once('class/checkdroits.class.php');
require_once('class/litigemsgs.class.php');
require_once('class/commandes.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_commande' => false, 'id_litigemsg' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => false,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
$commande = Commandes::getCommandeById($bddConnection, $_POST['id_commande']);
if (empty($commande)) {
    return array('status_code' => 404, 'message' => 'La commande n\'existe pas.');
}
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
$litigemsgs = LitigeMsgs::getLitigeMsgsByCommande($bddConnection, $_POST['id_commande']);
// si l'id du dernier litigemsg est different de l'id du litigemsg a supprimer alors on retourne une erreur
if (count($litigemsgs) == 0) {
    return array('status_code' => 400, 'message' => 'Il n\'y a pas de litigemsgs pour cette commande.');
}
if ($litigemsgs[count($litigemsgs) - 1]['id_msg_litige'] != $_POST['id_litigemsg']) {
    return array('status_code' => 400, 'message' => 'Le litigemsg a supprimer n\'est pas le dernier litigemsg.');
}
if ($litigemsgs[count($litigemsgs) - 1]['id_joueur'] != $sessionUser['idLogin']) {
    return array('status_code' => 400, 'message' => 'Le litigemsg a supprimer n\'a pas ete cree par vous.');
}
LitigeMsgs::deleteLitigemsg($bddConnection, $_POST['id_litigemsg']);
return array('status_code' => 200, 'message' => 'Le litigemsg a bien ete supprime.');