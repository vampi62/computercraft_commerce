<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/transactions.class.php');
require_once('class/comptes.class.php');

if (!Checkdroits::CheckArgs($_GET,array('userbanque' => false,'mdpbanque' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$joueur = Joueurs::getJoueurByPseudo($bddConnection, $_GET['userbanque']);
if (empty($joueur)) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (!Checkdroits::CheckMdp($bddConnection, $_GET['userbanque'], $_GET['mdpbanque'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
if (!Checkdroits::CheckRole($bddConnection, $_GET['userbanque'], array('admin','terminal'))) {
    return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
}
$transactions = Transactions::getTransactionsEnAttente($bddConnection);
if (empty($transactions)) {
    return array('status_code' => 200, 'message' => 'Il n\'y a pas de transactions en attente.');
}
foreach ($transactions as $transaction) {
    if (empty($transaction['id_compte_crediteur']) && empty($transaction['id_compte_debiteur'])) {
        Transactions::setStatusTransaction($bddConnection,$transaction['id_transaction'], 3, $joueur['id_joueur']);// refusé
        continue;
    }
    // verification compte debiteur a les fonds
    if (!empty($transaction['id_compte_debiteur'])) {
        $compteDebiteur = Comptes::getCompteById($bddConnection, $transaction['id_compte_debiteur']);
        if ($compteDebiteur['solde_compte'] < $transaction['somme_transaction']) {
            Transactions::setStatusTransaction($bddConnection,$transaction['id_transaction'], 3, $joueur['id_joueur']);// refusé
            continue;
        }
        Comptes::setCompteSolde($bddConnection,$compteDebiteur['id_compte'],($compteDebiteur['solde_compte'] - $transaction['somme_transaction']));
    }
    // verification compte crediteur existe
    if (!empty($transaction['id_compte_crediteur'])) {
        $compteCrediteur = Comptes::getCompteById($bddConnection, $transaction['id_compte_crediteur']);
        Comptes::setCompteSolde($bddConnection,$compteCrediteur['id_compte'],($compteCrediteur['solde_compte'] + $transaction['somme_transaction']));
    }
    Transactions::setStatusTransaction($bddConnection,$transaction['id_transaction'], 2, $joueur['id_joueur']);// accepté
}
return array('status_code' => 200, 'message' => 'Les transactions ont ete acceptees.');