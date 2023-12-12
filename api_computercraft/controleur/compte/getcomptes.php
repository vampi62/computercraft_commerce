<?php
require_once('class/joueurs.class.php');
require_once('class/comptes.class.php');
require_once('class/checkdroits.class.php');

$session_login = Checkdroits::CheckMode($bddConnection,array('apikey' => true,'user' => true));
if (isset($session_login['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $session_login; // error
}
if ($session_login[0]) {
    return array('status_code' => 200, 'message' => '' ,'data' => Comptes::getComptesWithApiKey($bddConnection, $session_login[1]));
} else {
    return array('status_code' => 200, 'message' => '' ,'data' => Comptes::getComptesWithUser($bddConnection, $session_login[1]));
}