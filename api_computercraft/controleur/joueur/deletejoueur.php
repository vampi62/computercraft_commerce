<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useruser' => false,'mdpuser' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$joueur = Joueurs::getJoueurByPseudo($bddConnection, $_GET['useruser']);
if (empty($joueur)) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (!Checkdroits::CheckMdp($bddConnection, $_GET['useruser'], $_GET['mdpuser'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
if (Checkdroits::CheckRole($bddConnection, $_GET['useruser'], array('admin'))) {
    return array('status_code' => 403, 'message' => 'Vous ne pouvez pas supprimer votre compte tant que vous etes admin.');
}
Joueurs::deleteJoueur($bddConnection, $joueur['id_joueur']);
return array('status_code' => 200, 'message' => 'votre compte a bien ete supprime.');