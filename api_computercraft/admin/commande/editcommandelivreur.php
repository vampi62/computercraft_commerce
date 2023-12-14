<?php
require_once('class/checkdroits.class.php');
require_once('class/commandes.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_commande' => false, 'id_livreur' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_commande'], 'commande')) {
    return array('status_code' => 404, 'message' => 'La commande n\'existe pas.');
}
if (!empty($_GET['id_livreur']) && !Checkdroits::checkId($bddConnection, $_GET['id_livreur'], 'livreur')) {
    return array('status_code' => 404, 'message' => 'Le livreur n\'existe pas.');
}
if (empty($_GET['id_livreur'])) {
    $_GET['id_livreur'] = null;
}
$suivi = $sessionAdmin['pseudoLogin'].' a changer le livreur : '. $_GET['id_livreur'] . ' via panel admin.';
$commande = new Commandes($bddConnection, $_GET['id_commande']);
$commande->setCommandeSuivi($suivi, $_Serveur_['General']['case_ligne_suite']);
$commande->setCommandeLivreur($_GET['id_livreur']);
return array('status_code' => 200, 'message' => '');