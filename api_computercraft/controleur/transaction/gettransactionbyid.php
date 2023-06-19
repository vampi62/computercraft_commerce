<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/transactions.class.php');
require_once('class/comptes.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useruser' => false,'mdpuser' => false, 'id_transaction' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$joueur = Joueurs::getJoueurByPseudo($bddConnection, $_GET['useruser']);
if (empty($joueur)) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (!Checkdroits::CheckMdp($bddConnection, $_GET['useruser'], $_GET['mdpuser'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
$transaction = Transactions::getTransactionById($bddConnection, $_GET['id_transaction']);
if (empty($transaction)) {
    return array('status_code' => 404, 'message' => 'La transaction n\'existe pas.');
}
if (Checkdroits::CheckPermObj($bddConnection, $joueur['id_joueur'], $transaction['id_compte_crediteur'], 'compte', 'gettransactions')) {
} elseif (Checkdroits::CheckPermObj($bddConnection, $joueur['id_joueur'], $transaction['id_compte_debiteur'], 'compte', 'gettransactions')) {
} else {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission de voir cette transaction.');
}
return array('status_code' => 200, 'message' => '', 'data' => $transaction);