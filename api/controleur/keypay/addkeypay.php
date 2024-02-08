<?php
require_once('class/checkdroits.class.php');
require_once('class/keypays.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_offre' => false,'quant' => false, 'prixu' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => true,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_POST['id_offre'], 'offre', 'addKeyPay', $sessionUser['isApi'])) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
}
if (!is_numeric($_POST['quant'])) {
    return array('status_code' => 400, 'message' => 'La quantite doit être un nombre.');
}
if (!is_numeric($_POST['prixu'])) {
    return array('status_code' => 400, 'message' => 'Le prix unitaire doit être un nombre.');
}
if ($_POST['quant'] <= 0) {
    return array('status_code' => 400, 'message' => 'La quantite doit être superieur a 0.');
}
if ($_POST['prixu'] <= 0) {
    return array('status_code' => 400, 'message' => 'Le prix unitaire doit être superieur a 0.');
}
$keypayId = Keypays::addKeypay($bddConnection, $_POST['id_offre'], Checkdroits::generatePassword(16), $_POST['quant'], $_POST['prixu']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $keypayId));