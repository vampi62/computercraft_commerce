<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_joueur' => false, 'pseudo' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (!empty(Joueurs::getJoueurByPseudo($bddConnection, $_GET['pseudo']))) {
    return array('status_code' => 400, 'message' => 'Le pseudo est deja utilise.');
}
if (strlen($_GET['pseudo']) > $_Serveur_['MaxLengthChamps']['Pseudo']) {
    return array('status_code' => 413, 'message' => 'Le pseudo est trop long.');
}
$joueur = new Joueurs($bddConnection, $_GET['id_joueur']);
$joueur->setJoueurPseudo($_GET['pseudo']);
return array('status_code' => 200, 'message' => 'Le pseudo a bien ete modifie.');