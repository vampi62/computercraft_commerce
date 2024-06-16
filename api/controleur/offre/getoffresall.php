<?php
require_once('class/checkdroits.class.php');
require_once('class/offres.class.php');

if (!Checkdroits::checkArgs($_GET,array('offset' => true, 'limit' => true, 'show_inactive' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$_GET['show_inactive'] = $_GET['show_inactive'] == "true" || $_GET['show_inactive'] == "1" ? false : true;
Checkdroits::checkLimitOffset($_Serveur_, $_GET['limit'], $_GET['offset']);
return array('status_code' => 200, 'message' => '', 'data' => Offres::getOffres($bddConnection,$_GET['show_inactive'], $_GET['limit'], $_GET['offset']));