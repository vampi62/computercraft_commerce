<?php
require_once('class/checkdroits.class.php');
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => true,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
return array('status_code' => 200, 'message' => '', 'data' => $sessionUser);