<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_POST,array('pseudo' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => false,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (strlen($_POST['pseudo']) > $_Serveur_['MaxLengthChamps']['Pseudo']) {
    return array('status_code' => 413, 'message' => 'Le pseudo est trop long.');
}
if (!empty(Joueurs::getJoueurByPseudo($bddConnection, $_POST['pseudo']))) {
    return array('status_code' => 403, 'message' => 'Le pseudo est deja pris.');
}
$joueur = new Joueurs($bddConnection, $sessionUser['idLogin']);
$joueur->setJoueurPseudo($_POST['pseudo']);
return array('status_code' => 200, 'message' => 'pseudo modifié');