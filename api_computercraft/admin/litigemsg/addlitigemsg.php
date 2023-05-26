<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/litigesmsg.class.php');

if(!Checkdroits::CheckArgs($_GET,array('useraction' => false,'mdp' => false, 'id' => false, 'description' => false, 'status' => false))) {
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
if(!Checkdroits::CheckId($bddConnection, $_GET['id'], 'commande')) {
    return array('status_code' => 404, 'message' => 'La commande n\'existe pas.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['status'], 'status_litige')) {
    return array('status_code' => 404, 'message' => 'Le status n\'existe pas.');
}
LitigesMsg::addLitigeMsg($bddConnection,$_GET['id'],$_GET['description'],$_GET['status']);
return array('status_code' => 200, 'message' => 'Le message a bien ete ajoute.');