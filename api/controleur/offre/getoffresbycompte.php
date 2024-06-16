<?php
require_once('class/checkdroits.class.php');
require_once('class/offres.class.php');

if (!Checkdroits::checkArgs($_GET,array('offset' => true, 'limit' => true, 'id_compte' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => true,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_GET['id_compte'], 'compte', 'getOffresByCompte', $sessionUser['isApi'])) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
}
Checkdroits::checkLimitOffset($_Serveur_, $_GET['limit'], $_GET['offset']);
return array('status_code' => 200, 'message' => '', 'data' => Offres::getOffresByCompte($bddConnection, $_GET['id_compte'], $_GET['limit'], $_GET['offset']));