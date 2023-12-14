<?php
require_once('class/checkdroits.class.php');
require_once('class/commandes.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_type_commande' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_type_commande'], 'type_commande')) {
    return array('status_code' => 404, 'message' => 'Le type n\'existe pas.');
}
return array('status_code' => 200, 'message' => '', 'data' => Commandes::getCommandesByStatus($bddConnection, $_GET['id_type_commande']));