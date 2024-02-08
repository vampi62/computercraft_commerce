<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_POST,array('email' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => false,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    return array('status_code' => 413, 'message' => 'L\'adresse mail est invalide.');
}
if (strlen($_POST['email']) > $_Serveur_['MaxLengthChamps']['Email']) {
    return array('status_code' => 413, 'message' => 'L\'email est trop long.');
}
$joueur = new Joueurs($bddConnection, $sessionUser['idLogin']);
$joueur->setJoueurEmail($_POST['email']);
return array('status_code' => 200, 'message' => '');