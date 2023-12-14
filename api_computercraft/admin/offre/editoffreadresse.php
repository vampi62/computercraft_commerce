<?php
require_once('class/checkdroits.class.php');
require_once('class/offres.class.php');
require_once('class/adresses.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_offre' => false, 'id_adresse' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_offre'], 'offre')) {
    return array('status_code' => 404, 'message' => 'L\'offre n\'existe pas.');
}
// le type d'adresse doit etre un point de vente pour pouvoir etre defini comme adresse de l'offre
if (!empty($_GET['id_adresse'])) {
    if (!Checkdroits::checkId($bddConnection, $_GET['id_adresse'], 'adresse')) {
        return array('status_code' => 404, 'message' => 'L\'adresse n\'existe pas.');
    }
    $adresse = Adresses::getAdresseById($bddConnection, $_GET['id_adresse']);
    if (!$adresse['id_type_adresse'] > 2) { // ne doit pas etre un point relais ou une reception
        return array('status_code' => 400, 'message' => 'Le type d\'adresse n\'est pas valide pour une offre.');
    }
} else {
    $_GET['id_adresse'] = null;
}
$offre = new Offres($bddConnection, $_GET['id_offre']);
$offre->setOffreAdresse($_GET['id_adresse']);
return array('status_code' => 200, 'message' => 'L\'adresse de l\'offre a bien ete modifie.');