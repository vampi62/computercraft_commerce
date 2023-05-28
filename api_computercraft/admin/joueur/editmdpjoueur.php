<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/joueurs.class.php');

if(!Checkdroits::CheckArgs($_GET,array('useraction' => false,'mdp' => false, 'id' => false, 'newmdp' => false))) {
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
if(!Checkdroits::CheckId($bddConnection, $_GET['id'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (!Checkdroits::CheckPasswordSecu($_GET['newmdp'])) {
    return array('status_code' => 400, 'message' => 'Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre.');
}
Joueurs::setJoueurMdp($bddConnection, $_GET['id'], $_GET['newmdp']);
return array('status_code' => 200, 'message' => 'Le mot de passe a bien ete modifie.');