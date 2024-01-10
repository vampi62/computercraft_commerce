<?php
require_once('class/checkdroits.class.php');
require_once('class/commandes.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_commande' => false, 'id_type_commande' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_commande'], 'commande')) {
    return array('status_code' => 404, 'message' => 'La commande n\'existe pas.');
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_type_commande'], 'type_commande')) {
    return array('status_code' => 404, 'message' => 'Le type n\'existe pas.');
}
$suivi = $sessionAdmin['pseudoLogin'].' a changer le status a '. $_POST['id_type_commande'] . ' via panel admin.';
$commande = new Commandes($bddConnection, $_POST['id_commande']);
$commande->setCommandeSuivi($suivi, $_Serveur_['General']['CaseLigneSuite']);
$commande->setCommandeStatus($_POST['id_type_commande']);
return array('status_code' => 200, 'message' => '');