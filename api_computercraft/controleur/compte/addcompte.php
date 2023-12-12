<?php
require_once('class/joueurs.class.php');
require_once('class/comptes.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::CheckArgs($_GET,array('nom' => false, 'id_type_compte' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$session_login = Checkdroits::CheckMode($bddConnection,array('apikey' => false,'user' => true));
if (isset($session_login['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $session_login; // error
}
if (!Checkdroits::CheckId($bddConnection, $_GET['id_type_compte'], 'type_compte')) {
    return array('status_code' => 404, 'message' => 'Le type n\'existe pas.');
}
if (strlen($_GET['nom']) > $_Serveur_['MaxLengthChamps']['nom']) {
    return array('status_code' => 413, 'message' => 'Le nom du compte est trop long.');
}
$newCompte = new Comptes($bddConnection);
$newCompte->addCompte($session_login[1], $_GET['id_type_compte'], $_GET['nom']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newCompte->getIdCompte()));