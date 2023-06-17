<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::CheckArgs($_GET,array('pseudo' => false,'mdp' => false,'email' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}