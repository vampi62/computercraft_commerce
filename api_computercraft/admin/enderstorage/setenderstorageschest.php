<?php
if (!$_Serveur_['Module']['enderstorage']) {
    return array('status_code' => 403, 'message' => 'Le module enderstorage est désactivé.');
}
require_once('class/checkdroits.class.php');
require_once('class/enderstorages.class.php');

if (!Checkdroits::checkArgs($_GET,array('reserver' => true, 'id_joueur' => true, 'id_enderchest' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_enderchest'], 'enderstorage_tank')) {
    return array('status_code' => 404, 'message' => 'cette enderstoragetank n\'existe pas.');
}
if (!is_bool($_GET['reserver']) && $_GET['reserver'] != "true" && $_GET['reserver'] != "false" && $_GET['reserver'] != "1" && $_GET['reserver'] != "0") {
    $_GET['reserver'] = false;
}
if ($_GET['reserver']) {
    if (!Checkdroits::checkId($bddConnection, $_GET['id_joueur'], 'joueur')) {
        return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
    }
    Enderstorages::setEnderStorageChest($bddConnection,$_GET['id_enderchest'],$_GET['id_joueur'],date('Y-m-d H:i:s'));
    return array('status_code' => 200, 'message' => 'L\'enderstoragetank a bien été reservé.');
} else {
    Enderstorages::setEnderStorageChest($bddConnection,$_GET['id_enderchest'],null,null);
    return array('status_code' => 200, 'message' => 'L\'enderstoragetank a bien été libéré.');
}