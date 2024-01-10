<?php
require_once('class/checkdroits.class.php');
require_once('class/offres.class.php');
require_once('class/adresses.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_offre' => false, 'id_adresse' => true), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => true,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_POST['id_offre'], 'offre', 'editOffreAdresse', $sessionUser['isApi'])) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
}
if (!empty($_POST['id_adresse'])) {
    if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_POST['id_adresse'], 'adresse', 'addAdresseToOffre', $sessionUser['isApi'])) {
        return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
    }
    $adresse = Adresses::getAdresseById($bddConnection, $_POST['id_adresse']);
    if (!$adresse['id_type_adresse'] > 2) { // ne doit pas etre un point relais ou une reception
        return array('status_code' => 400, 'message' => 'Le type d\'adresse n\'est pas valide pour une offre.');
    }
} else {
    $_POST['id_adresse'] = null;
}
$offre = new Offres($bddConnection, $_POST['id_offre']);
$offre->setOffreAdresse($_POST['id_adresse']);
return array('status_code' => 200, 'message' => 'L\'adresse de l\'offre a bien ete modifie.');