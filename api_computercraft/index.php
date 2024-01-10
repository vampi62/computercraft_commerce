<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, "fr_FR");

require ('init/config.php');
require ('init/connection_base.php');
if (!$_Serveur_['Install']) {
	$printmessage = require('installation/index.php');
} else {
	if (isset($_GET['admin'])) {
		$printmessage = require('admin/routeur.php');
	} else {
		$printmessage = require('controleur/routeur.php');
	}
}
if (isset($printmessage) && !empty($printmessage)) {
	http_response_code($printmessage['status_code']);
	echo json_encode($printmessage, JSON_UNESCAPED_UNICODE);
} else {
	http_response_code(404);
	echo json_encode(array(
		'status_code' => 404,
		'message' => 'Not Found'
	));
}