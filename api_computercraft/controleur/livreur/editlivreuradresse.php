<?php
require_once('class/checkdroits.class.php');
require_once('class/livreurs.class.php');
require_once('class/adresses.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_livreur' => false, 'id_adresse' => true), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => true,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_POST['id_livreur'], 'livreur', 'editLivreurAdresse', $sessionUser['isApi'])) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
}
if (!empty($_POST['id_adresse'])) {
    if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_POST['id_adresse'], 'adresse', 'addAdresseToLivreur', $sessionUser['isApi'])) {
        return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
    }
    $adresse = Adresses::getAdresseById($bddConnection, $_POST['id_adresse']);
    if (!$adresse['id_type_adresse'] == 2) { // ne doit pas etre autre chose qu'un point relais
        return array('status_code' => 400, 'message' => 'Le type d\'adresse n\'est pas valide pour un livreur.');
    }
} else {
    $_POST['id_adresse'] = null;
}
$livreur = new Livreurs($bddConnection, $_POST['id_livreur']);
$livreur->setLivreurAdresse($_POST['id_adresse']);
return array('status_code' => 200, 'message' => 'L\'adresse du livreur a bien ete modifie.');