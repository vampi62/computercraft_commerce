<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/groupes.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_groupe' => false, 'id_apikey' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_groupe'], 'groupe')) {
    return array('status_code' => 404, 'message' => 'Le groupe n\'existe pas.');
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_apikey'], 'apikey')) {
    return array('status_code' => 404, 'message' => 'L\'apikey n\'existe pas.');
}
$groupe = new Groupes($bddConnection, $_GET['id_groupe']);
$groupe->addGroupeApiKey($_GET['id_apikey']);
return array('status_code' => 200, 'message' => 'L\'apikey a bien ete ajoute au groupe.');