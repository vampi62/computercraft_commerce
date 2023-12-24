<?php
require_once('class/offres.class.php');

if (!Checkdroits::checkArgs($_GET,array('show_inactive' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
if (!is_bool($_GET['show_inactive']) && $_GET['show_inactive'] != "true" && $_GET['show_inactive'] != "false" && $_GET['show_inactive'] != "1" && $_GET['show_inactive'] != "0") {
    $_GET['show_inactive'] = null;
}
return array('status_code' => 200, 'message' => '', 'data' => Offres::getOffres($bddConnection,$_GET['show_inactive']));