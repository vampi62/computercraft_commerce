<?php
require_once('class/joueurs.class.php');
require_once('class/jetons.class.php');
require_once('class/checkdroits.class.php');

if(checkdroits::CheckArgs($_GET,array('pseudo','mdp'))) {



}
elseif (checkdroits::CheckArgs($_GET,array('apikey','mdp'))) {

} else {
    // modif - il manque des parametres
    $printmessage = array('status_code' => 400, 'message' => 'Il manque des paramètres.');
}