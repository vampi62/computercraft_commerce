<?php
require_once('class/checkdroits.class.php');
require_once('class/offres.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_offre' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
return array('status_code' => 200, 'message' => '', 'data' => Offres::getOffreById($bddConnection, $_GET['id_offre']));