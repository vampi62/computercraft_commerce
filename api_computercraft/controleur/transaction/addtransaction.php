<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/transactions.class.php');
require_once('class/comptes.class.php');

if (!Checkdroits::checkArgs($_GET,array('user' => false,'mdpuser' => false, 'userbanque' => true,'mdpbanque' => true, 'id_compte_debiteur' => false, 'id_compte_crediteur' => false, 'montant' => false, 'nom' => false, 'description' => false, 'id_type_transaction' => false, 'id_commande' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => true,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!empty($_GET['userbanque']) && !empty($_GET['mdpbanque'])) {
    $sessionBanque = Checkdroits::checkTerminalApi($bddConnection,$_GET);
    if (isset($sessionBanque['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
        return $sessionBanque; // error
    }
    if (Checkdroits::checkPermApi($bddConnection,$_GET['userbanque'],"addtransation")) {
        return array('status_code' => 404, 'message' => 'Vous n\'avez pas la permission de creer cette transaction.');
    }
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_type_transaction'], 'type_transaction')) {
    return array('status_code' => 404, 'message' => 'Le type de transaction n\'existe pas.');
}


if (empty($_GET['id_compte_debiteur']) && empty($_GET['id_compte_crediteur'])) {
    return array('status_code' => 400, 'message' => 'Il faut un compte debiteur ou un compte crediteur.');
}
if ($_GET['id_compte_debiteur'] == $_GET['id_compte_crediteur']) {
    return array('status_code' => 400, 'message' => 'Le compte debiteur et le compte crediteur sont identiques.');
}
if (!empty($_GET['id_commande'])) {
    if (!Checkdroits::checkId($bddConnection, $_GET['id_commande'], 'commande')) {
        return array('status_code' => 404, 'message' => 'La commande n\'existe pas.');
    }
}
if (strlen($_GET['nom']) > $_Serveur_['MaxLengthChamps']['nom']) {
    return array('status_code' => 413, 'message' => 'Le nom de la transaction est trop long.');
}
if (strlen($_GET['description']) > $_Serveur_['MaxLengthChamps']['description']) {
    return array('status_code' => 413, 'message' => 'La description est trop longue.');
}
if (!is_numeric($_GET['montant'])) {
    return array('status_code' => 400, 'message' => 'Le montant n\'est pas un nombre.');
}
if ($_GET['montant'] <= 0) {
    return array('status_code' => 400, 'message' => 'Le montant doit être superieur a 0.');
}
if ($_GET['id_compte_debiteur'] == "") {
    $_GET['id_compte_debiteur'] = null;
}
if ($_GET['id_compte_crediteur'] == "") {
    $_GET['id_compte_crediteur'] = null;
}
if ($_GET['id_commande'] == "") {
    $_GET['id_commande'] = null;
}

switch($_GET['id_type_transaction']) {
    case '1': // depot
        if ($sessionBanque == null) {
            return array('status_code' => 403, 'message' => 'Vous devez avoir un acces banque pour valider cette transaction.');
        }
        if (!Checkdroits::checkPermObj($bddConnection, $sessionBanque['idLogin'], $_GET['id_compte_crediteur'], 'compte', 'addtransactiondepot', $sessionBanque['isApi'])) {
            return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission de creer cette transaction.');
        }
    break;
    case '2': // retrait
        if ($sessionBanque == null) {
            return array('status_code' => 403, 'message' => 'Vous devez avoir un acces banque pour valider cette transaction.');
        }
        if (!Checkdroits::checkPermObj($bddConnection, $sessionBanque['idLogin'], $_GET['id_compte_debiteur'], 'compte', 'addtransactionretrait', $sessionBanque['isApi'])) {
            return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission de creer cette transaction.');
        }
    break;
    case '3': // remboursement
        if (empty($_GET['id_compte_debiteur']) || empty($_GET['id_compte_crediteur'])) {
            return array('status_code' => 400, 'message' => 'Il faut un compte debiteur et un compte crediteur.');
        }
        if (!Checkdroits::checkPermObj($bddConnection, $sessionBanque['idLogin'], $_GET['id_compte_debiteur'], 'compte', 'addtransactionremboursement', $sessionBanque['isApi'])) {
            return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission de creer cette transaction.');
        }
        if (!Checkdroits::checkId($bddConnection, $_GET['id_compte_crediteur'], 'compte')) {
            return array('status_code' => 404, 'message' => 'Le compte crediteur n\'existe pas.');
        }
    break;
    case '4': // achat
        if ($sessionBanque == null) {
            return array('status_code' => 403, 'message' => 'Vous devez avoir un acces banque pour valider cette transaction.');
        }
        if (empty($_GET['id_compte_debiteur']) || empty($_GET['id_compte_crediteur'])) {
            return array('status_code' => 400, 'message' => 'Il faut un compte debiteur et un compte crediteur.');
        }
        if (!Checkdroits::checkId($bddConnection, $_GET['id_compte_crediteur'], 'compte')) {
            return array('status_code' => 404, 'message' => 'Le compte crediteur n\'existe pas.');
        }
        if (!Checkdroits::checkId($bddConnection, $_GET['id_compte_debiteur'], 'compte')) {
            return array('status_code' => 404, 'message' => 'Le compte debiteur n\'existe pas.');
        }
    break;
    case '5': // livraison
        if (empty($_GET['id_compte_debiteur']) || empty($_GET['id_compte_crediteur'])) {
            return array('status_code' => 400, 'message' => 'Il faut un compte debiteur et un compte crediteur.');
        }
        if (!Checkdroits::checkId($bddConnection, $_GET['id_compte_crediteur'], 'compte')) {
            return array('status_code' => 404, 'message' => 'Le compte crediteur n\'existe pas.');
        }
        if ($sessionBanque == null) {
            if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_GET['id_compte_debiteur'], 'compte', 'addtransactionachat', $sessionUser['isApi'])) {
                return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission de creer cette transaction.');
            }
        } else {
            if (!Checkdroits::checkId($bddConnection, $_GET['id_compte_debiteur'], 'compte')) {
                return array('status_code' => 404, 'message' => 'Le compte debiteur n\'existe pas.');
            }
        }
    break;
    case '6': // transfert
        if (empty($_GET['id_compte_debiteur']) || empty($_GET['id_compte_crediteur'])) {
            return array('status_code' => 400, 'message' => 'Il faut un compte debiteur et un compte crediteur.');
        }
        if (!Checkdroits::checkId($bddConnection, $_GET['id_compte_crediteur'], 'compte')) {
            return array('status_code' => 404, 'message' => 'Le compte crediteur n\'existe pas.');
        }
        if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_GET['id_compte_debiteur'], 'compte', 'addtransactiontransfert', $sessionUser['isApi'])) {
            return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission de creer cette transaction.');
        }
    break;
    case '7': // abonnement
        return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission de creer cette transaction.');
    break;
}
$idAdmin = null;
if ($sessionBanque != null) {
    $idAdmin = $sessionBanque['idLogin'];
}
$newid = Transactions::addTransaction($bddConnection, $_GET['id_compte_debiteur'], $_GET['id_compte_crediteur'],$idAdmin, $_GET['montant'], $_GET['nom'], $_GET['description'], $_GET['id_type_transaction'], $_GET['id_commande']);
return array('status_code' => 200, 'message' => 'La transaction a bien ete cree.', 'data' => array('id' => $newid));