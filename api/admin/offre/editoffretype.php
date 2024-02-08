<?php
require_once('class/checkdroits.class.php');
require_once('class/offres.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_offre' => false, 'id_type' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_offre'], 'offre')) {
    return array('status_code' => 404, 'message' => 'L\'offre n\'existe pas.');
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_type'], 'type_offre')) {
    return array('status_code' => 404, 'message' => 'Le type n\'existe pas.');
}
$offre = new Offres($bddConnection, $_POST['id_offre']);
$offre->setOffreType($_POST['id_type']);
return array('status_code' => 200, 'message' => 'Le type de l\'offre a bien ete modifie.');