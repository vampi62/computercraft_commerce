<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_joueur' => false, 'id_type_role' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if ($_POST['id_joueur'] == $sessionAdmin['idLogin']) {
    return array('status_code' => 403, 'message' => 'Vous ne pouvez pas modifier votre role.');
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_type_role'], 'type_role')) {
    return array('status_code' => 404, 'message' => 'Le role n\'existe pas.');
}
$joueur = new Joueurs($bddConnection, $_POST['id_joueur']);
$joueur->setJoueurRole($_POST['id_type_role']);
return array('status_code' => 200, 'message' => 'Le role a bien ete modifie.');