<?php
require_once('class/checkdroits.class.php');
require_once('class/offres.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_offre' => false, 'stock' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => true,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_GET['id_offre'], 'offre', 'editoffrestock', $sessionUser['isApi'])) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
}
if (!is_numeric($_GET['stock'])) {
    return array('status_code' => 400, 'message' => 'Le stock n\'est pas un nombre.');
}
if (($_GET['stock']) < 0) {
    return array('status_code' => 400, 'message' => 'Le stock doit être positif.');
}
$offre = new Offres($bddConnection, $_GET['id_offre']);
$offre->setOffreStock($_GET['stock']);
return array('status_code' => 200, 'message' => 'Le stock de l\'offre a bien ete modifie.');