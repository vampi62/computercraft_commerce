<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_GET,array('mdp' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => false,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkPasswordSecu($_GET['mdp'])) {
    return array('status_code' => 400, 'message' => 'Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre.');
}
$joueur = new Joueurs($bddConnection, $sessionUser['idLogin']);
$joueur->setJoueurMdp($_GET['mdp']);
return array('status_code' => 200, 'message' => 'mot de passe modifié');