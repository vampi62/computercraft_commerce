<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/transactions.class.php');
require_once('class/comptes.class.php');

if(!Checkdroits::CheckArgs($_GET,array('useradmin' => false,'mdpadmin' => false, 'idcomptecrediteur' => false, 'idcomptedebiteur' => false, 'montant' => false, 'nom' => false, 'description' => false, 'id_status_transaction' => false, 'id_type_transaction' => false, 'id_commande' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$donneesJoueurUserAdmin = Joueurs::getJoueurbyPseudo($bddConnection, $_GET['useradmin']);
if(empty($donneesJoueurUserAdmin['pseudo'])) {
    return array('status_code' => 404, 'message' => 'Le compte useradmin n\'existe pas.');
}
if(!Checkdroits::CheckMdp($bddConnection, $_GET['useradmin'], $_GET['mdpadmin'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
if(!Checkdroits::CheckRole($bddConnection, $_GET['useradmin'], array('admin'))) {
    return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['id_type_transaction'], 'type_transaction')) {
    return array('status_code' => 404, 'message' => 'Le type n\'existe pas.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['id_status_transaction'], 'status_transaction')) {
    return array('status_code' => 404, 'message' => 'Le status n\'existe pas.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['id_compte_crediteur'], 'compte')) {
    return array('status_code' => 404, 'message' => 'Le compte crediteur n\'existe pas.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['id_compte_debiteur'], 'compte')) {
    return array('status_code' => 404, 'message' => 'Le compte debiteur n\'existe pas.');
}
if (!empty($_GET['id_commande'])) {
    if(!Checkdroits::CheckId($bddConnection, $_GET['id_commande'], 'commande')) {
        return array('status_code' => 404, 'message' => 'La commande n\'existe pas.');
    }
}
if (len($_GET['nom']) > $_Serveur_['General']['MaxLengthChamps']['nom']) {
    return array('status_code' => 400, 'message' => 'Le nom de la transaction est trop long.');
}
if (len($_GET['description']) > $_Serveur_['General']['MaxLengthChamps']['description']) {
    return array('status_code' => 400, 'message' => 'La description est trop longue.');
}
if (!is_numeric($_GET['montant'])) {
    return array('status_code' => 400, 'message' => 'Le montant n\'est pas un nombre.');
}
if ($_GET['montant'] <= 0) {
    return array('status_code' => 400, 'message' => 'Le montant doit être superieur a 0.');
}
$comptedeb = Comptes::getCompteById($bddConnection,$_GET['id_compte_debiteur']);
if ($comptedeb['solde'] < $_GET['montant']) {
    return array('status_code' => 400, 'message' => 'Le montant est superieur au solde du compte debiteur.');
}
Transactions::addTransaction($bddConnection,$_GET['id_compte_debiteur'],$_GET['id_compte_crediteur'],$donneesJoueurUserAdmin['id_joueur'],$_GET['montant'],$_GET['nom'],$_GET['description'],$_GET['id_status_transaction'],$_GET['id_type_transaction'],$_GET['id_commande']);
Comptes::setSoldeCompte($bddConnection,$_GET['id_compte_debiteur'],($comptedeb['solde'] - $_GET['montant']));
Comptes::setSoldeCompte($bddConnection,$_GET['id_compte_crediteur'],($comptecred['solde'] + $_GET['montant']));
return array('status_code' => 200, 'message' => 'La transaction a bien ete ajoutee.');