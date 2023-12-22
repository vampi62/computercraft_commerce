<?php
require_once('class/checkdroits.class.php');
require_once('class/keypays.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_offre' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => true,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_GET['id_offre'], 'offre', 'getallkeypay', $sessionUser['isApi'])) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
}
return array('status_code' => 200, 'message' => '', 'data' => Keypays::getKeypaysByOffre($bddConnection, $_GET['id_offre']));