<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/transactions.class.php');
require_once('class/comptes.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_transaction' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => true,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
$transaction = Transactions::getTransactionById($bddConnection, $_GET['id_transaction']);
if (empty($transaction)) {
    return array('status_code' => 404, 'message' => 'La transaction n\'existe pas.');
}
if (Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $transaction['id_compte_crediteur'], 'compte', 'getTransactionsByCompte')) {
} elseif (Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $transaction['id_compte_debiteur'], 'compte', 'getTransactionsByCompte')) {
} else {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission de voir cette transaction.');
}
return array('status_code' => 200, 'message' => '', 'data' => $transaction);