<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/commandes.class.php');

if(checkdroits::CheckArgs($_GET,array('useraction' => false,'mdp' => false, 'nom' => false, 'quant' => false, 'prixu' => false, 'frait' => false, 'description' => false, 'suivi' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$donneesJoueurUserAction = Joueur::getJoueurbyPseudo($bddConnection, $_GET['useraction']);
if(empty($donneesJoueurUserAction['pseudo'])) {
    return array('status_code' => 404, 'message' => 'Le compte useraction n\'existe pas.');
}
if(!checkdroits::CheckMdp($bddConnection, $_GET['useraction'], $_GET['mdp'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
if(!checkdroits::CheckRole($bddConnection, $_GET['useraction'], array('admin'))) {
    return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
}
if(!checkdroits::CheckId($bddConnection, $_GET['type'], 'type_adresse')) {
    return array('status_code' => 404, 'message' => 'Le type n\'existe pas.');
}
if(!checkdroits::CheckId($bddConnection, $_GET['id'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
Commandes::addCommande($bddConnection,$_GET['nom'],$_GET['quant'],$_GET['prixu'],$_GET['frait'],$_GET['description'],$_GET['coderetrait'],$_GET['id_adresse_vendeur'],$_GET['id_adresse_client'],$_GET['id_offre'],$_GET['id_compte_vendeur'],$_GET['id_compte_client'],$_GET['id_type_commande']);
return array('status_code' => 200, 'message' => '');