<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/adresses.class.php');

if(checkdroits::CheckArgs($_GET,array('useraction' => false,'mdp' => false, 'id' => false, 'coo' => false, 'nom' => false, 'description' => false, 'type' => false, 'livreur' => true))) {
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
Adresses::addAdresse($bddConnection, $_GET['id'], $_GET['coo'], $_GET['nom'], $_GET['description'], $_GET['type'], $_GET['livreur']);
return array('status_code' => 200, 'message' => '');