<?php
require_once('class/checkdroits.class.php');
require_once('class/keypays.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_offre' => false,'quant' => false, 'prixu' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => true,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_GET['id_offre'], 'offre', 'addkeypay', $sessionUser['isApi'])) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
}
if (!is_numeric($_GET['quant'])) {
    return array('status_code' => 400, 'message' => 'La quantite doit être un nombre.');
}
if (!is_numeric($_GET['prixu'])) {
    return array('status_code' => 400, 'message' => 'Le prix unitaire doit être un nombre.');
}
if ($_GET['quant'] <= 0) {
    return array('status_code' => 400, 'message' => 'La quantite doit être superieur a 0.');
}
if ($_GET['prixu'] <= 0) {
    return array('status_code' => 400, 'message' => 'Le prix unitaire doit être superieur a 0.');
}
$keypayId = Keypays::addKeypay($bddConnection, $_GET['id_offre'], Checkdroits::generatePassword(16), $_GET['quant'], $_GET['prixu']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $keypayId));