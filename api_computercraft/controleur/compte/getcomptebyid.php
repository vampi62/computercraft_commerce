<?php
require_once('class/joueurs.class.php');
require_once('class/comptes.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::CheckArgs($_GET,array('id_compte' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$session_login = Checkdroits::CheckMode($bddConnection,array('apikey' => true,'user' => true));
if (isset($session_login['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $session_login; // error
}
if (!Checkdroits::CheckId($bddConnection, $_GET['id_compte'], 'compte')) {
    return array('status_code' => 404, 'message' => 'Le compte n\'existe pas.');
}
if (!Checkdroits::CheckPermObj($bddConnection, $joueur['id_joueur'], $_GET['id_compte'], 'compte', 'getcomptes',$session_login[0])) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
}
return array('status_code' => 200, 'message' => '' ,'data' => Comptes::getCompteById($bddConnection, $_GET['id_compte']));