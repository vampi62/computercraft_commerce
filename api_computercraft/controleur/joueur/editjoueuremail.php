<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::CheckArgs($_GET, array('pseudo' => false,'mdp' => false, 'newemail' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$donneesJoueurUser = Joueurs::getJoueurbyPseudo($bddConnection, $_GET['pseudo']);
if (empty($donneesJoueurUser['pseudo_joueur'])) {
    return array('status_code' => 404, 'message' => 'Le compte useradmin n\'existe pas.');
}
if (!Checkdroits::CheckMdp($bddConnection, $_GET['pseudo'], $_GET['mdp'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
if (!filter_var($_GET['newemail'], FILTER_VALIDATE_EMAIL)) {
	return array('status_code' => 413, 'message' => 'L\'adresse mail est invalide.');
}
if (strlen($_GET['newemail']) > $_Serveur_['MaxLengthChamps']['email']) {
	return array('status_code' => 413, 'message' => 'L\'email est trop long.');
}
Joueurs::editJoueurEmail($bddConnection, $donneesJoueurUser['id_joueur'], $_GET['newemail']);
return array('status_code' => 200, 'message' => 'L\'email a bien ete modifie.');