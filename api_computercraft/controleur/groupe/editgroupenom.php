<?php
require_once('class/checkdroits.class.php');
require_once('class/groupes.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_groupe' => false, 'nom' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => false,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkProprioObj($bddConnection, $sessionUser['idLogin'], $_GET['id_groupe'], 'groupe')) {
    return array('status_code' => 404, 'message' => 'ce groupe n\'existe pas ou ne vous appartient pas.');
}
if (strlen($_GET['nom']) > $_Serveur_['MaxLengthChamps']['Nom']) {
    return array('status_code' => 413, 'message' => 'Le nom du groupe est trop long.');
}
$groupe = new Groupes($bddConnection, $_GET['id_groupe']);
$groupe->setGroupeNom($_GET['nom']);
return array('status_code' => 200, 'message' => 'Le nom du groupe a bien ete modifie.');