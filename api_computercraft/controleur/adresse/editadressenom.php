<?php
require_once('class/checkdroits.class.php');
require_once('class/adresses.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_adresse' => false, 'nom' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => true,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_POST['id_adresse'], 'adresse', "editAdresseNom", $sessionUser['isApi'])) {
    return array('status_code' => 404, 'message' => 'cette adresse n\'existe pas ou ne vous appartient pas.');
}
if (strlen($_POST['nom']) > $_Serveur_['MaxLengthChamps']['Nom']) {
    return array('status_code' => 413, 'message' => 'Le nom de l\'adresse est trop long.');
}
$adresse = new Adresses($bddConnection, $_POST['id_adresse']);
$adresse->setAdresseNom($_POST['nom']);
return array('status_code' => 200, 'message' => '');