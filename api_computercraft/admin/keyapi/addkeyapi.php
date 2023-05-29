<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/keyapis.class.php');

if(!Checkdroits::CheckArgs($_GET,array('useradmin' => false,'mdpadmin' => false, 'id_joueur' => false, 'nom' => false, 'mdp' => false))) {
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
if(Keyapis::getKeyapiByNom($bddConnection, $_GET['id_joueur'] . '-' . $_GET['nom'])['nom_keyapi'] != null) {
    return array('status_code' => 403, 'message' => 'Le nom de la keyapi est deja utilise.');
}
if (!len($_GET['nom']) <= 50) {
    return array('status_code' => 400, 'message' => 'Le nom est trop long.');
}
if (!Checkdroits::CheckPasswordSecu($_GET['mdp'])) {
    return array('status_code' => 400, 'message' => 'Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre.');
}
Keyapis::addKeyapi($bddConnection,$_GET['nom'], $_GET['mdp'], $_GET['id_joueur']);
return array('status_code' => 200, 'message' => '');