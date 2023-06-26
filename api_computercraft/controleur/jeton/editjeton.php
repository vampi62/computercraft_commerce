<?php
require_once('class/joueurs.class.php');
require_once('class/jetons.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useruser' => false,'mdpuser' => false, '1' => false, '10' => false, '100' => false, '1k' => false, '10k' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$joueur = Joueurs::getJoueurByPseudo($bddConnection, $_GET['useruser']);
if (empty($joueur)) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (!Checkdroits::CheckRole($bddConnection, $_GET['useruser'], array('terminal'))) {
    return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
}
if (!Checkdroits::CheckMdp($bddConnection, $_GET['useruser'], $_GET['mdpuser'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
if (empty(Jetons::getJetonByJoueur($bddConnection, $joueur['id_joueur']))) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'a pas de jeton creer.');
}
Jetons::setJeton($bddConnection, $joueur['id_joueur'] , $_GET);
return array('status_code' => 200, 'message' => 'Le jeton a bien ete modifie.');