<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/transactions.class.php');
require_once('class/comptes.class.php');

if(!Checkdroits::CheckArgs($_GET,array('useraction' => false,'mdp' => false, 'idcomptecrediteur' => false, 'idcomptedebiteur' => false, 'montant' => false, 'nom' => false, 'description' => false, 'id_status_transaction' => false, 'id_type_transaction' => false, 'id_commande' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$donneesJoueurUserAction = Joueurs::getJoueurbyPseudo($bddConnection, $_GET['useraction']);
if(empty($donneesJoueurUserAction['pseudo'])) {
    return array('status_code' => 404, 'message' => 'Le compte useraction n\'existe pas.');
}
if(!Checkdroits::CheckMdp($bddConnection, $_GET['useraction'], $_GET['mdp'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
if(!Checkdroits::CheckRole($bddConnection, $_GET['useraction'], array('admin'))) {
    return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['id_type_transaction'], 'type_transaction')) {
    return array('status_code' => 404, 'message' => 'Le type n\'existe pas.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['id_status_transaction'], 'status_transaction')) {
    return array('status_code' => 404, 'message' => 'Le status n\'existe pas.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['idcomptecrediteur'], 'compte')) {
    return array('status_code' => 404, 'message' => 'Le compte crediteur n\'existe pas.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['idcomptedebiteur'], 'compte')) {
    return array('status_code' => 404, 'message' => 'Le compte debiteur n\'existe pas.');
}
if (!empty($_GET['id_commande'])) {
    if(!Checkdroits::CheckId($bddConnection, $_GET['id_commande'], 'commande')) {
        return array('status_code' => 404, 'message' => 'La commande n\'existe pas.');
    }
}
if (!is_numeric($_GET['montant'])) {
    return array('status_code' => 400, 'message' => 'Le montant n\'est pas un nombre.');
}
if ($_GET['montant'] <= 0) {
    return array('status_code' => 400, 'message' => 'Le montant doit être superieur a 0.');
}
$comptedeb = Comptes::getCompteById($bddConnection,$_GET['idcomptedebiteur']);
if ($comptedeb['solde'] < $_GET['montant']) {
    return array('status_code' => 400, 'message' => 'Le montant est superieur au solde du compte debiteur.');
}
Transactions::addTransaction($bddConnection,$_GET['idcomptedebiteur'],$_GET['idcomptecrediteur'],$donneesJoueurUserAction['id_joueur'],$_GET['montant'],$_GET['nom'],$_GET['description'],$_GET['id_status_transaction'],$_GET['id_type_transaction'],$_GET['id_commande']);
Comptes::setSoldeCompte($bddConnection,$_GET['idcomptedebiteur'],($comptedeb['solde'] - $_GET['montant']));
Comptes::setSoldeCompte($bddConnection,$_GET['idcomptecrediteur'],($comptecred['solde'] + $_GET['montant']));
return array('status_code' => 200, 'message' => 'La transaction a bien ete ajoutee.');