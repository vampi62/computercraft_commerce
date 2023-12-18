<?php
require_once('class/checkdroits.class.php');
require_once('class/groupes.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_groupe' => false, 'id_droit' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => false,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkProprioObj($bddConnection, $sessionUser['idLogin'], $_GET['id_groupe'], 'groupe')) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas les droits pour ajouter un droit a ce groupe.');
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_droit'], 'droit')) {
    return array('status_code' => 404, 'message' => 'Le droit n\'existe pas.');
}
$groupe = new Groupes($bddConnection, $_GET['id_groupe']);
$groupe->addGroupeDroit($_GET['id_droit']);
return array('status_code' => 200, 'message' => 'Le droit a bien ete ajoute au groupe.');