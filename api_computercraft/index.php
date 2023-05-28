<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, "fr_FR");

require ('controleur/config.php');
require ('controleur/connection_base.php');
if (!$_Serveur_['Install']) {
	$printmessage = require('installation/index.php');
} else {
	if (isset($_GET['action'])) {
		$printmessage = require('controleur/action.php');
	} else {
		$printmessage = array('status_code' => 400, 'message' => 'Action non definie.');
	}
}
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
if (isset($printmessage) && !empty($printmessage)) {
	http_response_code($printmessage['status_code']);
	echo json_encode($printmessage);
}
?>