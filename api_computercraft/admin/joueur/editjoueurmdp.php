<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_joueur' => false, 'mdp' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (!Checkdroits::checkPasswordSecu($_GET['mdp'])) {
    return array('status_code' => 400, 'message' => 'Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre.');
}
$joueur = new Joueurs($bddConnection, $_GET['id_joueur']);
$joueur->setJoueurMdp($_GET['mdp']);
return array('status_code' => 200, 'message' => 'Le mot de passe a bien ete modifie.');