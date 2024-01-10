<?php
require_once('class/checkdroits.class.php');
require_once('class/livreurs.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_livreur' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => false,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkProprioObj($bddConnection, $sessionUser['idLogin'], $_POST['id_compte'], 'compte')) {
    return array('status_code' => 404, 'message' => 'ce livreur n\'existe pas ou ne vous appartient pas.');
}
//update // condition si un commande est en cours avec ce livreur alors on ne peut pas le supprimer
$livreur = new Livreurs($bddConnection, $_POST['id_livreur']);
$livreur->deleteLivreur();
return array('status_code' => 200, 'message' => 'Le livreur a bien ete supprime.');