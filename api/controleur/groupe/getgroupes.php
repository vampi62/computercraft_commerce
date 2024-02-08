<?php
require_once('class/checkdroits.class.php');
require_once('class/groupes.class.php');

$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => true,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if ($sessionUser['isApi']) {
    return array('status_code' => 200, 'message' => '' ,'data' => Groupes::getGroupesByApiKey($bddConnection, $sessionUser['idLogin']));
} else {
    $groupesMembre = Groupes::getGroupesByJoueurMembre($bddConnection, $sessionUser['idLogin']);
    $groupesProprio = Groupes::getGroupesByJoueur($bddConnection, $sessionUser['idLogin']);
    return array('status_code' => 200, 'message' => '' ,'data' => array_merge($groupesMembre,$groupesProprio));
}