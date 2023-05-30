<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/joueurs.class.php');

if(!Checkdroits::CheckArgs($_GET,array('useradmin' => false,'mdpadmin' => false, 'id_joueur' => false, 'pseudo' => false))) {
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
if(!Checkdroits::CheckId($bddConnection, $_GET['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (Joueurs::getJoueurbyPseudo($bddConnection, $_GET['pseudo'])['pseudo'] != null) {
    return array('status_code' => 400, 'message' => 'Le pseudo est deja utilise.');
}
if (!len($_GET['pseudo']) <= $_Serveur_['General']['MaxLengthChamps']['pseudo']) {
    return array('status_code' => 400, 'message' => 'Le pseudo est trop long.');
}
Joueurs::setJoueurPseudo($bddConnection, $_GET['id_joueur'], $_GET['pseudo']);
return array('status_code' => 200, 'message' => 'Le pseudo a bien ete modifie.');