<?php
require_once('class/joueurs.class.php');
require_once('class/jetons.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useruser' => false,'mdpuser' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
if (empty(Joueurs::getJoueurByPseudo($bddConnection, $_GET['useruser']))) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (!Checkdroits::CheckRole($bddConnection, $_GET['useradmin'], array('admin','terminal'))) {
    return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
}
if (!Checkdroits::CheckMdp($bddConnection, $_GET['useruser'], $_GET['mdpuser'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
return array('status_code' => 200, 'message' => '', 'jetons' => Jetons::getJetons($bddConnection));