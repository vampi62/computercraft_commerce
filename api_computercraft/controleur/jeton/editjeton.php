<?php
require_once('class/jetons.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_GET,array('1' => false, '10' => false, '100' => false, '1k' => false, '10k' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => false,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkRole($bddConnection, $sessionUser['pseudoLogin'], array('terminal'))) {
    return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
}
if (empty(Jetons::getJetonByJoueur($bddConnection, $sessionUser['idLogin']))) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'a pas de jeton creer.');
}
Jetons::setJeton($bddConnection, $sessionUser['idLogin'] , $_GET);
return array('status_code' => 200, 'message' => 'Le jeton a bien ete modifie.');