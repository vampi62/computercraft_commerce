<?php
require_once('class/checkdroits.class.php');
require_once('class/jetons.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_joueur' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (Jetons::getJetonByJoueur($bddConnection, $_GET['id_joueur'])) {
    return array('status_code' => 404, 'message' => 'Le joueur a deja un jeton creer.');
}
$newJeton = new Jetons($bddConnection);
$newJeton->addJeton($_GET['id_joueur']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newJeton->getIdJoueurJeton()));