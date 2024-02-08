<?php
require_once('class/checkdroits.class.php');
require_once('class/groupes.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_groupe' => false, 'id_joueur' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_groupe'], 'groupe')) {
    return array('status_code' => 404, 'message' => 'Le groupe n\'existe pas.');
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
$groupe = new Groupes($bddConnection, $_POST['id_groupe']);
$groupe->deleteGroupeJoueur($_POST['id_joueur']);
return array('status_code' => 200, 'message' => 'Le joueur a bien ete supprime du groupe.');