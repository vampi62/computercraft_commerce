<?php
require_once('class/joueurs.class.php');
require_once('class/comptes.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::CheckArgs($_GET,array('nom' => false, 'id_compte' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$session_login = Checkdroits::CheckMode($bddConnection,array('apikey' => true,'user' => true));
if (isset($session_login['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $session_login; // error
}
if (strlen($_GET['nom']) > $_Serveur_['MaxLengthChamps']['nom']) {
    return array('status_code' => 413, 'message' => 'Le nom du compte est trop long.');
}
if (!Checkdroits::CheckPermObj($bddConnection, $session_login[1], $_GET['id_compte'], 'compte', 'editcomptenom', $session_login[0])) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
}
$compte = new Comptes($bddConnection, $_GET['id_compte']);
$compte->setCompteNom($_GET['nom']);
return array('status_code' => 200, 'message' => 'Le nom du compte a bien ete modifie.');