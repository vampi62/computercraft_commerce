<?php
require_once('class/checkdroits.class.php');
require_once('class/keypays.class.php');

if (!Checkdroits::checkArgs($_GET,array('offset' => true, 'limit' => true, 'id_offre' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_offre'], 'offre')) {
    return array('status_code' => 404, 'message' => 'L\'offre n\'existe pas.');
}
Checkdroits::checkLimitOffset($_Serveur_, $_GET['limit'], $_GET['offset']);
return array('status_code' => 200, 'message' => '', 'data' => Keypays::getKeypaysByOffre($bddConnection, $_GET['id_offre'], $_GET['limit'], $_GET['offset']));