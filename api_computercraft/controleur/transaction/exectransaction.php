<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/transactions.class.php');
require_once('class/comptes.class.php');

if (!Checkdroits::checkArgs($_GET,array('userbanque' => false,'mdpbanque' => false, 'id_transaction' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => false,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkRole($bddConnection, $_GET['userbanque'], array('admin','terminal'))) {
    return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_transaction'], 'transaction')) {
    return array('status_code' => 404, 'message' => 'La transaction n\'existe pas.');
}
$transaction = Transactions::getTransactionById($bddConnection,$_GET['id_transaction']);
if ($transaction['id_type_status_transaction'] != 1) {
    return array('status_code' => 403, 'message' => 'La transaction a deja ete executee.');
}

function setstatusifadminnull($bddConnection,$transaction,$status,$joueur) {
    if ($transaction['id_admin'] == null) {
        Transactions::setStatusTransaction($bddConnection,$transaction['id_transaction'], $status, $joueur);
    }
    else {
        Transactions::setStatusTransaction($bddConnection,$transaction['id_transaction'], $status, $transaction['id_admin']);
    }
}


if (!empty($transaction['id_compte_debiteur'])) {
    $comptedeb = Comptes::getCompteById($bddConnection,$transaction['id_compte_debiteur']);
    if ($comptedeb['solde_compte'] < $transaction['somme_transaction']) {
        setstatusifadminnull($bddConnection,$transaction, 3, $joueur['id_joueur']);// refusé
        return array('status_code' => 403, 'message' => 'Le compte debiteur n\'a pas assez d\'argent.');
    }
    Comptes::setCompteSolde($bddConnection,$transaction['id_compte_debiteur'],($comptedeb['solde_compte'] - $transaction['somme_transaction']));
}
if (!empty($transaction['id_compte_crediteur'])) {
    $comptecred = Comptes::getCompteById($bddConnection,$transaction['id_compte_crediteur']);
    Comptes::setCompteSolde($bddConnection,$transaction['id_compte_crediteur'],($comptecred['solde_compte'] + $transaction['somme_transaction']));
}
setstatusifadminnull($bddConnection,$transaction, 2, $joueur['id_joueur']);// accepté
return array('status_code' => 200, 'message' => 'La transaction est valide.');