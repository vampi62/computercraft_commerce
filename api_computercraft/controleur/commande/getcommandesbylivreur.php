<?php
require_once('class/checkdroits.class.php');
require_once('class/commandes.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_livreur' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => true,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_livreur'], 'livreur', 'getcommande', $sessionUser['isApi'])) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas les droits pour effectuer cette action.');
}
return array('status_code' => 200, 'message' => '', 'data' => Commandes::getCommandesByLivreur($bddConnection, $_GET['id_livreur']));