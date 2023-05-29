<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/litigemsgs.class.php');

if(!Checkdroits::CheckArgs($_GET,array('useradmin' => false,'mdpadmin' => false, 'id_commande' => false, 'description' => false, 'id_status_litigemsg' => false))) {
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
if(!Checkdroits::CheckId($bddConnection, $_GET['id_commande'], 'commande')) {
    return array('status_code' => 404, 'message' => 'La commande n\'existe pas.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['id_status_litigemsg'], 'status_litigemsg')) {
    return array('status_code' => 404, 'message' => 'Le status n\'existe pas.');
}
if (!len($_GET['description']) <= 450) {
    return array('status_code' => 400, 'message' => 'Le message est trop long.');
}
LitigeMsgs::addLitigeMsg($bddConnection,$_GET['id_commande'],$_GET['description'],$_GET['id_status_litigemsg']);
return array('status_code' => 200, 'message' => 'Le message a bien ete ajoute.');