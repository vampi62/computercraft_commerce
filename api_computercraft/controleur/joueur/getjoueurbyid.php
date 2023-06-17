<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useruser' => false,'mdpuser' => false, 'id_joueur' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}