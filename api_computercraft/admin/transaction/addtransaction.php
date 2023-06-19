<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/transactions.class.php');
require_once('class/comptes.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useradmin' => false,'mdpadmin' => false, 'id_compte_crediteur' => true, 'id_compte_debiteur' => true, 'montant' => false, 'nom' => false, 'description' => false, 'id_type_transaction' => false, 'id_commande' => true))) {
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
if (!Checkdroits::CheckId($bddConnection, $_GET['id_type_transaction'], 'type_transaction')) {
    return array('status_code' => 404, 'message' => 'Le type n\'existe pas.');
}
if (!empty($_GET['id_compte_crediteur']) && !Checkdroits::CheckId($bddConnection, $_GET['id_compte_crediteur'], 'compte')) {
    return array('status_code' => 404, 'message' => 'Le compte crediteur n\'existe pas.');
}
if (!empty($_GET['id_compte_debiteur']) && !Checkdroits::CheckId($bddConnection, $_GET['id_compte_debiteur'], 'compte')) {
    return array('status_code' => 404, 'message' => 'Le compte debiteur n\'existe pas.');
}
if (empty($_GET['id_compte_debiteur']) && empty($_GET['id_compte_crediteur'])) {
    return array('status_code' => 400, 'message' => 'Il faut un compte debiteur ou compte crediteur.');
}
if ($_GET['id_compte_debiteur'] == $_GET['id_compte_crediteur']) {
    return array('status_code' => 400, 'message' => 'Le compte debiteur et le compte crediteur sont identiques.');
}
if (!empty($_GET['id_commande'])) {
    if (!Checkdroits::CheckId($bddConnection, $_GET['id_commande'], 'commande')) {
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
$newid = Transactions::addTransaction($bddConnection,$_GET['id_compte_debiteur'],$_GET['id_compte_crediteur'],$donneesJoueurUserAdmin['id_joueur'],$_GET['montant'],$_GET['nom'],$_GET['description'],$_GET['id_type_transaction'],$_GET['id_commande']);
return array('status_code' => 200, 'message' => 'La transaction a bien ete ajoutee.', 'data' => array('id' => $newid));