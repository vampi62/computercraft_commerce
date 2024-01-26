<?php
require_once('class/checkdroits.class.php');
require_once('class/transactions.class.php');
require_once('class/comptes.class.php');
require_once('class/apikeys.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_compte_debiteur' => true, 'id_compte_crediteur' => true, 'montant' => false, 'nom' => false, 'description' => false, 'id_type_transaction' => false, 'id_commande' => true), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => true,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!empty($_POST['userbanque']) && !empty($_POST['mdpbanque'])) {
    $sessionBanque = Checkdroits::checkTerminalApi($bddConnection,$_POST, true);
    if (isset($sessionBanque['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
        return $sessionBanque; // error
    }
    $apikeyBanque = Apikeys::getApiKeyById($bddConnection, $sessionBanque['idLogin']);
    if (!Checkdroits::checkRole($bddConnection, $apikeyBanque['pseudo_joueur'], array('terminal','traitement'))) {
        return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
    }
}
if ($sessionUser['isApi']) {
    if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $sessionUser['idLogin'], 'apikey', 'addTransactionViaApiKey', $sessionUser['isApi'])) {
        return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
    }
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_type_transaction'], 'type_transaction')) {
    return array('status_code' => 404, 'message' => 'Le type de transaction n\'existe pas.');
}
if (empty($_POST['id_compte_debiteur']) && empty($_POST['id_compte_crediteur'])) {
    return array('status_code' => 400, 'message' => 'Il faut un compte debiteur ou un compte crediteur.');
}
if ($_POST['id_compte_debiteur'] == $_POST['id_compte_crediteur']) {
    return array('status_code' => 400, 'message' => 'Le compte debiteur et le compte crediteur sont identiques.');
}
if (!empty($_POST['id_commande']) && $_POST['id_commande'] != null && $_POST['id_commande'] != "" && $_POST['id_commande'] != "null") {
    if (!Checkdroits::checkId($bddConnection, $_POST['id_commande'], 'commande')) {
        return array('status_code' => 404, 'message' => 'La commande n\'existe pas.');
    }
}
if (strlen($_POST['nom']) > $_Serveur_['MaxLengthChamps']['Nom']) {
    return array('status_code' => 413, 'message' => 'Le nom de la transaction est trop long.');
}
if (strlen($_POST['description']) > $_Serveur_['MaxLengthChamps']['Description']) {
    return array('status_code' => 413, 'message' => 'La description est trop longue.');
}
if (!is_numeric($_POST['montant'])) {
    return array('status_code' => 400, 'message' => 'Le montant n\'est pas un nombre.');
}
if ($_POST['montant'] <= 0) {
    return array('status_code' => 400, 'message' => 'Le montant doit être superieur a 0.');
}
if ($_POST['id_compte_debiteur'] == "") {
    $_POST['id_compte_debiteur'] = null;
}
if ($_POST['id_compte_crediteur'] == "") {
    $_POST['id_compte_crediteur'] = null;
}
if ($_POST['id_commande'] == "" || $_POST['id_commande'] == "null") {
    $_POST['id_commande'] = null;
}

function checkCompte($bddConnection, $idCompte, $montant, $sens) {
    if (!Checkdroits::checkId($bddConnection, $idCompte, 'compte')) {
        if ($sens == 'crediteur') {
            return array('status_code' => 404, 'message' => 'Le compte crediteur n\'existe pas.');
        } else {
            return array('status_code' => 404, 'message' => 'Le compte debiteur n\'existe pas.');
        }
    }
    $compte = new Comptes($bddConnection, $idCompte);
    if ($sens == 'crediteur') {
        $compte->setCompteSolde($compte->getSolde() + $montant);
    } else {
        if ($compte->getSolde() < $montant) {
            return array('status_code' => 403, 'message' => 'Le compte debiteur n\'a pas assez d\'argent.');
        }
        $compte->setCompteSolde($compte->getSolde() - $montant);
    }
    return array('status_code' => 200, 'message' => '');
}

$idAdmin = null;
switch($_POST['id_type_transaction']) {
    case '1': // retrait // action effectuer sur un pc banque
        if (empty($sessionBanque)) {
            return array('status_code' => 403, 'message' => 'Vous devez avoir un acces banque pour valider cette transaction.');
        }
        if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_POST['id_compte_debiteur'], 'compte', 'addtransactionretrait', $sessionUser['isApi'])) {
            return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission de creer cette transaction.');
        }
        $idAdmin = $apikeyBanque['id_joueur'];
        $statusCompte = checkCompte($bddConnection, $_POST['id_compte_debiteur'], $_POST['montant'], 'debiteur');
        if ($statusCompte['status_code'] != 200) {
            return $statusCompte;
        }
        $_POST['id_compte_crediteur'] = null;
    break;
    case '2': // depot // action effectuer sur un pc banque
        if (empty($sessionBanque)) {
            return array('status_code' => 403, 'message' => 'Vous devez avoir un acces banque pour valider cette transaction.');
        }
        if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_POST['id_compte_crediteur'], 'compte', 'addtransactiondepot', $sessionUser['isApi'])) {
            return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission de creer cette transaction.');
        }
        $idAdmin = $apikeyBanque['id_joueur'];
        $statusCompte = checkCompte($bddConnection, $_POST['id_compte_crediteur'], $_POST['montant'], 'crediteur');
        if ($statusCompte['status_code'] != 200) {
            return $statusCompte;
        }
        $_POST['id_compte_debiteur'] = null;
    break;
    case '3': // achat // action effectuer sur un pc banque
        if (empty($sessionBanque)) {
            return array('status_code' => 403, 'message' => 'Vous devez avoir un acces banque pour valider cette transaction.');
        }
        if (empty($_POST['id_compte_debiteur']) || empty($_POST['id_compte_crediteur'])) {
            return array('status_code' => 400, 'message' => 'Il faut un compte debiteur et un compte crediteur.');
        }
        if (!Checkdroits::checkId($bddConnection, $_POST['id_compte_crediteur'], 'compte')) {
            return array('status_code' => 404, 'message' => 'Le compte crediteur n\'existe pas.');
        }
        if (!Checkdroits::checkId($bddConnection, $_POST['id_compte_debiteur'], 'compte')) {
            return array('status_code' => 404, 'message' => 'Le compte debiteur n\'existe pas.');
        }
        if (empty($_POST['id_commande']) || $_POST['id_commande'] == null || $_POST['id_commande'] == "") {
            return array('status_code' => 400, 'message' => 'Il faut une commande.');
        }
        $idAdmin = $apikeyBanque['id_joueur'];
        $statusCompte = checkCompte($bddConnection, $_POST['id_compte_debiteur'], $_POST['montant'], 'debiteur');
        if ($statusCompte['status_code'] != 200) {
            return $statusCompte;
        }
        $statusCompte = checkCompte($bddConnection, $_POST['id_compte_crediteur'], $_POST['montant'], 'crediteur');
        if ($statusCompte['status_code'] != 200) {
            return $statusCompte;
        }
    break;
    case '4': // remboursement
        if (empty($_POST['id_compte_debiteur']) || empty($_POST['id_compte_crediteur'])) {
            return array('status_code' => 400, 'message' => 'Il faut un compte debiteur et un compte crediteur.');
        }
        if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_POST['id_compte_debiteur'], 'compte', 'addtransactionremboursement', $sessionUser['isApi'])) {
            return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission de creer cette transaction.');
        }
        if (!Checkdroits::checkId($bddConnection, $_POST['id_compte_crediteur'], 'compte')) {
            return array('status_code' => 404, 'message' => 'Le compte crediteur n\'existe pas.');
        }
        if (empty($_POST['id_commande']) || $_POST['id_commande'] == null || $_POST['id_commande'] == "") {
            return array('status_code' => 400, 'message' => 'Il faut une commande.');
        }
        $statusCompte = checkCompte($bddConnection, $_POST['id_compte_debiteur'], $_POST['montant'], 'debiteur');
        if ($statusCompte['status_code'] != 200) {
            return $statusCompte;
        }
        $statusCompte = checkCompte($bddConnection, $_POST['id_compte_crediteur'], $_POST['montant'], 'crediteur');
        if ($statusCompte['status_code'] != 200) {
            return $statusCompte;
        }
    break;
    case '5': // livraison
        if (empty($_POST['id_compte_debiteur']) || empty($_POST['id_compte_crediteur'])) {
            return array('status_code' => 400, 'message' => 'Il faut un compte debiteur et un compte crediteur.');
        }
        if (!Checkdroits::checkId($bddConnection, $_POST['id_compte_crediteur'], 'compte')) {
            return array('status_code' => 404, 'message' => 'Le compte crediteur n\'existe pas.');
        }
        if (empty($_POST['id_commande']) || $_POST['id_commande'] == null || $_POST['id_commande'] == "") {
            return array('status_code' => 400, 'message' => 'Il faut une commande.');
        }
        if (empty($sessionBanque)) {
            if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_POST['id_compte_debiteur'], 'compte', 'addtransactionachat', $sessionUser['isApi'])) {
                return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission de creer cette transaction.');
            }
        } else {
            if (!Checkdroits::checkId($bddConnection, $_POST['id_compte_debiteur'], 'compte')) {
                return array('status_code' => 404, 'message' => 'Le compte debiteur n\'existe pas.');
            }
        }
        $statusCompte = checkCompte($bddConnection, $_POST['id_compte_debiteur'], $_POST['montant'], 'debiteur');
        if ($statusCompte['status_code'] != 200) {
            return $statusCompte;
        }
        $statusCompte = checkCompte($bddConnection, $_POST['id_compte_crediteur'], $_POST['montant'], 'crediteur');
        if ($statusCompte['status_code'] != 200) {
            return $statusCompte;
        }
    break;
    case '6': // transfert
        if (empty($_POST['id_compte_debiteur']) || empty($_POST['id_compte_crediteur'])) {
            return array('status_code' => 400, 'message' => 'Il faut un compte debiteur et un compte crediteur.');
        }
        if (!Checkdroits::checkId($bddConnection, $_POST['id_compte_crediteur'], 'compte')) {
            return array('status_code' => 404, 'message' => 'Le compte crediteur n\'existe pas.');
        }
        if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_POST['id_compte_debiteur'], 'compte', 'addtransactiontransfert', $sessionUser['isApi'])) {
            return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission de creer cette transaction.');
        }
        $statusCompte = checkCompte($bddConnection, $_POST['id_compte_debiteur'], $_POST['montant'], 'debiteur');
        if ($statusCompte['status_code'] != 200) {
            return $statusCompte;
        }
        $statusCompte = checkCompte($bddConnection, $_POST['id_compte_crediteur'], $_POST['montant'], 'crediteur');
        if ($statusCompte['status_code'] != 200) {
            return $statusCompte;
        }
    break;
    case '7': // abonnement
        return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission de creer cette transaction.');
    break;
}
$newId = Transactions::addTransaction($bddConnection, $_POST['id_compte_debiteur'], $_POST['id_compte_crediteur'],$idAdmin, $_POST['montant'], $_POST['nom'], $_POST['description'], $_POST['id_type_transaction'], $_POST['id_commande']);
return array('status_code' => 200, 'message' => 'La transaction a bien ete cree.', 'data' => array('id' => $newId));