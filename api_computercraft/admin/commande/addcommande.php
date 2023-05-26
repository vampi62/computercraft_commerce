<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/commandes.class.php');

if(!Checkdroits::CheckArgs($_GET,array('useraction' => false,'mdp' => false, 'nom' => false, 'quant' => false, 'prixu' => false, 'frait' => false, 'description' => false, 'coderetrait' => false, 'id_adresse_vendeur' => false, 'id_adresse_client' => false, 'id_offre' => false, 'id_compte_vendeur' => false, 'id_compte_client' => false, 'id_type_commande' => false))) {
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
if(!Checkdroits::CheckId($bddConnection, $_GET['type'], 'type_adresse')) {
    return array('status_code' => 404, 'message' => 'Le type n\'existe pas.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['id_adresse_vendeur'], 'adresse')) {
    return array('status_code' => 404, 'message' => 'L\'adresse vendeur n\'existe pas.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['id_adresse_client'], 'adresse')) {
    return array('status_code' => 404, 'message' => 'L\'adresse client n\'existe pas.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['id_offre'], 'offre')) {
    return array('status_code' => 404, 'message' => 'L\'offre n\'existe pas.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['id_compte_vendeur'], 'compte')) {
    return array('status_code' => 404, 'message' => 'Le compte vendeur n\'existe pas.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['id_compte_client'], 'compte')) {
    return array('status_code' => 404, 'message' => 'Le compte client n\'existe pas.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['id_type_commande'], 'type_commande')) {
    return array('status_code' => 404, 'message' => 'Le type de commande n\'existe pas.');
}
if($_GET['quant'] < 1) {
    return array('status_code' => 400, 'message' => 'La quantite doit être superieur a 0.');
}
if($_GET['prixu'] < 0) {
    return array('status_code' => 400, 'message' => 'Le prix unitaire doit être superieur a 0.');
}
if($_GET['frait'] <= 0) {
    return array('status_code' => 400, 'message' => 'Les frais de port doivent être superieur ou egal a 0.');
}

Commandes::addCommande($bddConnection,$_GET['nom'],$_GET['quant'],$_GET['prixu'],$_GET['frait'],$_GET['description'],$_GET['coderetrait'],$_GET['id_adresse_vendeur'],$_GET['id_adresse_client'],$_GET['id_offre'],$_GET['id_compte_vendeur'],$_GET['id_compte_client'],$_GET['id_type_commande']);
return array('status_code' => 200, 'message' => '');