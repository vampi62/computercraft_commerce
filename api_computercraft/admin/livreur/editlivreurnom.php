<?php
require_once('class/checkdroits.class.php');
require_once('class/livreurs.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_livreur' => false, 'nom' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_livreur'], 'livreur')) {
    return array('status_code' => 404, 'message' => 'Le livreur n\'existe pas.');
}
if (strlen($_GET['nom']) > $_Serveur_['MaxLengthChamps']['Nom']) {
    return array('status_code' => 413, 'message' => 'Le nom du livreur est trop long.');
}
$livreur = new Livreurs($bddConnection, $_GET['id_livreur']);
$livreur->setLivreurNom($_GET['nom']);
return array('status_code' => 200, 'message' => 'Le nom du livreur a bien ete modifie.');