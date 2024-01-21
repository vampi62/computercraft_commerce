<?php
require_once('class/checkdroits.class.php');
require_once('class/offres.class.php');

if (!Checkdroits::checkArgs($_GET,array('show_inactive' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$_GET['show_inactive'] = $_GET['show_inactive'] == "true" || $_GET['show_inactive'] == "1" ? false : true;
return array('status_code' => 200, 'message' => '', 'data' => Offres::getOffres($bddConnection,$_GET['show_inactive']));