<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_GET,array('pseudo' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => false,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (strlen($_GET['pseudo']) > $_Serveur_['MaxLengthChamps']['pseudo']) {
    return array('status_code' => 413, 'message' => 'Le pseudo est trop long.');
}
if (!empty(Joueurs::getJoueurByPseudo($bddConnection, $_GET['pseudo']))) {
    return array('status_code' => 403, 'message' => 'Le pseudo est deja pris.');
}
Joueurs::setJoueurPseudo($bddConnection, $sessionUser['idLogin'], $_GET['pseudo']);
return array('status_code' => 200, 'message' => '');