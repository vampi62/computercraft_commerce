<?php
require_once('class/checkdroits.class.php');
require_once('class/commandes.class.php');

if (!Checkdroits::checkArgs($_GET,array('offset' => true, 'limit' => true, 'id_adresse' => false, 'id_status' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_adresse'], 'adresse')) {
    return array('status_code' => 404, 'message' => 'L\'adresse n\'existe pas.');
}
if (!empty($_GET['id_status']) && !Checkdroits::checkId($bddConnection, $_GET['id_status'], 'type_commande')) {
    return array('status_code' => 404, 'message' => 'Le type n\'existe pas.');
}
Checkdroits::checkLimitOffset($_Serveur_, $_GET['limit'], $_GET['offset']);
return array('status_code' => 200, 'message' => '', 'data' => Commandes::getCommandesByAdresseClient($bddConnection, $_GET['id_adresse'], $_GET['id_status'], $_GET['limit'], $_GET['offset']));