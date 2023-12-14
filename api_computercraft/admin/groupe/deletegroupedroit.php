<?php
require_once('class/checkdroits.class.php');
require_once('class/groupes.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_groupe' => false, 'id_droit' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_groupe'], 'groupe')) {
    return array('status_code' => 404, 'message' => 'Le groupe n\'existe pas.');
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_droit'], 'droit')) {
    return array('status_code' => 404, 'message' => 'Le droit n\'existe pas.');
}
$groupe = new Groupes($bddConnection, $_GET['id_groupe']);
$groupe->deleteGroupeDroit($_GET['id_droit']);
return array('status_code' => 200, 'message' => 'Le droit a bien ete supprime du groupe.');