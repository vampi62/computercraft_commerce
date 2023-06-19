<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/keyapis.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useradmin' => false,'mdpadmin' => false, 'id_keyapi' => false, 'mdp' => false))) {
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
if (!Checkdroits::CheckId($bddConnection, $_GET['id_keyapi'], 'keyapi')) {
    return array('status_code' => 404, 'message' => 'La keyapi n\'existe pas.');
}
if (!Checkdroits::CheckPasswordSecu($_GET['mdp'])) {
    return array('status_code' => 400, 'message' => 'Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre.');
}
if (strlen($_GET['mdp']) > $_Serveur_['MaxLengthChamps']['code']) {
    return array('status_code' => 413, 'message' => 'Le mot de passe est trop long.');
}
Keyapis::setKeyapiMdp($bddConnection, $_GET['id_keyapi'], $_GET['mdp']);
return array('status_code' => 200, 'message' => 'Le mot de passe de la keyapi a bien ete modifie.');