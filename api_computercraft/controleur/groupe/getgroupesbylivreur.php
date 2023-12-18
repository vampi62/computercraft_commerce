<?php
require_once('class/checkdroits.class.php');
require_once('class/groupes.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_livreur' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => false,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkProprioObj($bddConnection, $sessionUser['idLogin'], $_GET['id_livreur'], 'livreur')) {
    return array('status_code' => 404, 'message' => 'ce livreur n\'existe pas ou ne vous appartient pas.');
}
return array('status_code' => 200 , 'message' => '', 'data' => Groupe::getGroupesByLivreur($bddConnection, $_GET['id_livreur']));