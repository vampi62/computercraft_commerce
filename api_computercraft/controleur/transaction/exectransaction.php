<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/transactions.class.php');
require_once('class/comptes.class.php');

if (!Checkdroits::CheckArgs($_GET,array('userbanque' => false,'mdpbanque' => false, 'id_transaction' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}