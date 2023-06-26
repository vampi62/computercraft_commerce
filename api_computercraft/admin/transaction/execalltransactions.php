<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/transactions.class.php');
require_once('class/comptes.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useradmin' => false,'mdpadmin' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$donneesJoueurUserAdmin = Joueurs::getJoueurByPseudo($bddConnection, $_GET['useradmin']);
if (empty($donneesJoueurUserAdmin['pseudo_joueur'])) {
    return array('status_code' => 404, 'message' => 'Le compte useradmin n\'existe pas.');
}
if (!Checkdroits::CheckMdp($bddConnection, $_GET['useradmin'], $_GET['mdpadmin'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
if (!Checkdroits::CheckRole($bddConnection, $_GET['useradmin'], array('admin'))) {
    return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
}
$transactions = Transactions::getTransactionsEnAttente($bddConnection);
if (empty($transactions)) {
    return array('status_code' => 404, 'message' => 'Il n\'y a pas de transactions en attente.');
}

function setstatusifadminnull($bddConnection,$transaction,$status,$JoueurUserAdmin) {
    if ($transaction['id_admin'] == null) {
        Transactions::setStatusTransaction($bddConnection,$transaction['id_transaction'], $status, $JoueurUserAdmin);
    } else {
        Transactions::setStatusTransaction($bddConnection,$transaction['id_transaction'], $status, $transaction['id_admin']);
    }
}

foreach ($transactions as $transaction) {
    if (empty($transaction['id_compte_crediteur']) && empty($transaction['id_compte_debiteur'])) {
        setstatusifadminnull($bddConnection,$transaction, 3, $donneesJoueurUserAdmin['id_joueur']);// refusé
        continue;
    }
    // verification compte debiteur a les fonds
    if (!empty($transaction['id_compte_debiteur'])) {
        $compteDebiteur = Comptes::getCompteById($bddConnection, $transaction['id_compte_debiteur']);
        if ($compteDebiteur['solde_compte'] < $transaction['somme_transaction']) {
            setstatusifadminnull($bddConnection,$transaction, 3, $donneesJoueurUserAdmin['id_joueur']);// refusé
            continue;
        }
        Comptes::setCompteSolde($bddConnection,$compteDebiteur['id_compte'],($compteDebiteur['solde_compte'] - $transaction['somme_transaction']));
    }
    // verification compte crediteur existe
    if (!empty($transaction['id_compte_crediteur'])) {
        $compteCrediteur = Comptes::getCompteById($bddConnection, $transaction['id_compte_crediteur']);
        Comptes::setCompteSolde($bddConnection,$compteCrediteur['id_compte'],($compteCrediteur['solde_compte'] + $transaction['somme_transaction']));
    }
    setstatusifadminnull($bddConnection,$transaction, 2, $donneesJoueurUserAdmin['id_joueur']);// accepté
}
return array('status_code' => 200, 'message' => 'Les transactions ont été acceptées.');