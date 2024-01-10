<?php
require_once('class/checkdroits.class.php');
require_once('class/commandes.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_commande' => false, 'id_livreur' => true), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => true,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
$commande = Commandes::getCommandeById($bddConnection, $_POST['id_commande']);
if (empty($commande)) {
    return array('status_code' => 404, 'message' => 'La commande n\'existe pas.');
}
if ($commande['id_livreur'] != null) {
    return array('status_code' => 403, 'message' => 'La commande est deja prise en charge par un livreur.');
}
if ($commande['id_type_commande'] != 6) { // 6 = en attente de livreur
    return array('status_code' => 403, 'message' => 'La commande n\'est pas en attente de livreur.');
}
if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_livreur'], 'livreur', 'livreurValideNewCommande', $sessionUser['isApi'])) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas les droits pour effectuer cette action.');
}
$suivi = $sessionAdmin['pseudoLogin'].' a accepter la livraison de la commande par le livreur : '. $_POST['id_livreur'];
$commande = new Commandes($bddConnection, $_POST['id_commande']);
$commande->setCommandeSuivi($suivi, $_Serveur_['General']['CaseLigneSuite']);
$commande->setCommandeLivreur($_POST['id_livreur']);
return array('status_code' => 200, 'message' => '');