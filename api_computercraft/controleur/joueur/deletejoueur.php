<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::CheckArgs($_GET, array('pseudo' => false,'mdp' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$donneesJoueurUser = Joueurs::getJoueurbyPseudo($bddConnection, $_GET['pseudo']);
if (empty($donneesJoueurUser['pseudo_joueur'])) {
    return array('status_code' => 404, 'message' => 'Le compte useradmin n\'existe pas.');
}
if (!Checkdroits::CheckMdp($bddConnection, $_GET['pseudo'], $_GET['mdp'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
Joueurs::deleteJoueur($bddConnection, $donneesJoueurUser['id_joueur']);
return array('status_code' => 200, 'message' => 'Le joueur a bien ete supprime.');