<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/commandes.class.php');

if(checkdroits::CheckArgs($_GET,array('useraction' => false,'mdp' => false, 'id' => false))) {
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
if(!checkdroits::CheckId($bddConnection, $_GET['id'], 'adresse')) {
    return array('status_code' => 404, 'message' => 'L\'adresse n\'existe pas.');
}
return array('status_code' => 200, 'message' => '', 'data' => Commandes::getCommandesByAdresseClient($bddConnection, $_GET['id']));