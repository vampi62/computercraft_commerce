<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_GET,array('pseudo' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
$donneesJoueurUser = Joueurs::getJoueurByPseudo($bddConnection, $_GET['pseudo']);
if (empty($donneesJoueurUser['pseudo_joueur'])) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
return array('status_code' => 200, 'message' => '', 'data' => $donneesJoueurUser);