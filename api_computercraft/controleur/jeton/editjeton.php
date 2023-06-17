<?php
require_once('class/joueurs.class.php');
require_once('class/jetons.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useruser' => false,'mdpuser' => false, '1' => false, '10' => false, '100' => false, '1k' => false, '10k' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}