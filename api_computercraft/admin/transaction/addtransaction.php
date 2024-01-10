<?php
require_once('class/checkdroits.class.php');
require_once('class/transactions.class.php');
require_once('class/comptes.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_compte_crediteur' => true, 'id_compte_debiteur' => true, 'montant' => false, 'nom' => false, 'description' => false, 'id_type_transaction' => false, 'id_commande' => true), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_type_transaction'], 'type_transaction')) {
    return array('status_code' => 404, 'message' => 'Le type n\'existe pas.');
}
if (!empty($_POST['id_compte_crediteur']) && !Checkdroits::checkId($bddConnection, $_POST['id_compte_crediteur'], 'compte')) {
    return array('status_code' => 404, 'message' => 'Le compte crediteur n\'existe pas.');
}
if (!empty($_POST['id_compte_debiteur']) && !Checkdroits::checkId($bddConnection, $_POST['id_compte_debiteur'], 'compte')) {
    return array('status_code' => 404, 'message' => 'Le compte debiteur n\'existe pas.');
}
if (empty($_POST['id_compte_debiteur']) && empty($_POST['id_compte_crediteur'])) {
    return array('status_code' => 400, 'message' => 'Il faut un compte debiteur ou compte crediteur.');
}
if ($_POST['id_compte_debiteur'] == $_POST['id_compte_crediteur']) {
    return array('status_code' => 400, 'message' => 'Le compte debiteur et le compte crediteur sont identiques.');
}
if (!empty($_POST['id_commande'])) {
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
if ($_POST['id_commande'] == "") {
    $_POST['id_commande'] = null;
}
if (empty($_POST['id_compte_crediteur']) && empty($_POST['id_compte_debiteur'])) {
    return array('status_code' => 400, 'message' => 'Il faut un compte debiteur ou compte crediteur.');
}
if (!empty($_POST['id_compte_debiteur'])) {
    $compteDebiteur = new Comptes($bddConnection, $_POST['id_compte_debiteur']);
    if ($compteDebiteur->getSolde() < $_POST['montant']) {
        return array('status_code' => 403, 'message' => 'Le compte debiteur n\'a pas assez d\'argent.');
    }
    $compteDebiteur->setCompteSolde($compteDebiteur->getSolde() - $_POST['montant']);
}
if (!empty($_POST['id_compte_crediteur'])) {
    $compteCrediteur = new Comptes($bddConnection, $_POST['id_compte_crediteur']);
    $compteCrediteur->setCompteSolde($compteCrediteur->getSolde() + $_POST['montant']);
}
$newid = Transactions::addTransaction($bddConnection,$_POST['id_compte_debiteur'],$_POST['id_compte_crediteur'],$sessionAdmin['idLogin'],$_POST['montant'],$_POST['nom'],$_POST['description'],$_POST['id_type_transaction'],$_POST['id_commande']);
return array('status_code' => 200, 'message' => 'La transaction a bien ete ajoutee.', 'data' => array('id' => $newid));