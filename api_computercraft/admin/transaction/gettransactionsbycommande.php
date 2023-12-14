<?php
require_once('class/checkdroits.class.php');
require_once('class/transactions.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_commande' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_commande'], 'commande')) {
    return array('status_code' => 404, 'message' => 'La commande n\'existe pas.');
}
return array('status_code' => 200, 'message' => '', 'data' => Transactions::getTransactionsByCommande($bddConnection, $_GET['id_commande']));