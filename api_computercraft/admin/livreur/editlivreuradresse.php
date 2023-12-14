<?php
require_once('class/checkdroits.class.php');
require_once('class/livreurs.class.php');
require_once('class/adresses.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_livreur' => false, 'id_adresse' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_livreur'], 'livreur')) {
    return array('status_code' => 404, 'message' => 'Le livreur n\'existe pas.');
}
if (!empty($_GET['id_adresse'])) {
    if (!Checkdroits::checkId($bddConnection, $_GET['id_adresse'], 'adresse')) {
        return array('status_code' => 404, 'message' => 'L\'adresse n\'existe pas.');
    }
    $adresse = Adresses::getAdresseById($bddConnection, $_GET['id_adresse']);
    if (!$adresse['id_type_adresse'] == 2) { // ne doit pas etre autre chose qu'un point relais
        return array('status_code' => 400, 'message' => 'Le type d\'adresse n\'est pas valide pour un livreur.');
    }
} else {
    $_GET['id_adresse'] = null;
}
$livreur = new Livreurs($bddConnection, $_GET['id_livreur']);
$livreur->setLivreurAdresse($_GET['id_adresse']);
return array('status_code' => 200, 'message' => 'L\'adresse du livreur a bien ete modifie.');