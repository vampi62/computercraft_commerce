<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_joueur' => false, 'email' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (strlen($_GET['email']) > $_Serveur_['MaxLengthChamps']['Email']) {
    return array('status_code' => 413, 'message' => 'L\'email est trop long.');
}
$joueur = new Joueurs($bddConnection, $_GET['id_joueur']);
$joueur->setJoueurEmail($_GET['email']);
return array('status_code' => 200, 'message' => 'L\'email a bien ete modifie.');