<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => false,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (Checkdroits::checkRole($bddConnection, $sessionUser['pseudoLogin'], array('admin'))) {
    return array('status_code' => 403, 'message' => 'Vous ne pouvez pas supprimer votre compte tant que vous etes admin.');
}
$joueur = new Joueurs($bddConnection, $sessionUser['idLogin']);
$joueur->deleteJoueur();
return array('status_code' => 200, 'message' => 'votre compte a bien ete supprime.');