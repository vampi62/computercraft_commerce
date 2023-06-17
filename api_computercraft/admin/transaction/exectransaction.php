<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/transactions.class.php');
require_once('class/comptes.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useradmin' => false,'mdpadmin' => false, 'id_transaction' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$donneesJoueurUserAdmin = Joueurs::getJoueurbyPseudo($bddConnection, $_GET['useradmin']);
if (empty($donneesJoueurUserAdmin['pseudo_joueur'])) {
    return array('status_code' => 404, 'message' => 'Le compte useradmin n\'existe pas.');
}
if (!Checkdroits::CheckMdp($bddConnection, $_GET['useradmin'], $_GET['mdpadmin'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
if (!Checkdroits::CheckRole($bddConnection, $_GET['useradmin'], array('admin'))) {
    return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
}
if (!Checkdroits::CheckId($bddConnection, $_GET['id_transaction'], 'transaction')) {
    return array('status_code' => 404, 'message' => 'La transaction n\'existe pas.');
}
$transaction = Transactions::getTransactionById($bddConnection,$_GET['id_transaction']);
if ($transaction['id_type_status_transaction'] != 1) {
    return array('status_code' => 403, 'message' => 'La transaction a deja ete executee.');
}

function setstatusifadminnull($bddConnection,$transaction,$status,$JoueurUserAdmin) {
    if ($transaction['id_admin'] == null) {
        Transactions::setStatusTransaction($bddConnection,$transaction['id_transaction'], $status, $JoueurUserAdmin);
    }
    else {
        Transactions::setStatusTransaction($bddConnection,$transaction['id_transaction'], $status, $transaction['id_admin']);
    }
}


if (!empty($transaction['id_compte_debiteur'])) {
    $comptedeb = Comptes::getCompteById($bddConnection,$transaction['id_compte_debiteur']);
    if ($comptedeb['solde'] < $transaction['somme_transaction']) {
        setstatusifadminnull($bddConnection,$transaction, 3, $donneesJoueurUserAdmin['id_joueur']);// refusé
        return array('status_code' => 403, 'message' => 'Le compte debiteur n\'a pas assez d\'argent.');
    }
    Comptes::setCompteSolde($bddConnection,$transaction['id_compte_debiteur'],($comptedeb['solde_compte'] - $transaction['somme_transaction']));
}
if (!empty($transaction['id_compte_crediteur'])) {
    $comptecred = Comptes::getCompteById($bddConnection,$transaction['id_compte_crediteur']);
    Comptes::setCompteSolde($bddConnection,$transaction['id_compte_crediteur'],($comptecred['solde_compte'] + $transaction['somme_transaction']));
}
setstatusifadminnull($bddConnection,$transaction, 2, $donneesJoueurUserAdmin['id_joueur']);// accepté
return array('status_code' => 200, 'message' => 'La transaction est valide.');