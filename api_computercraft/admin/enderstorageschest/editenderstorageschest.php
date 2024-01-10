<?php
if (!$_Serveur_['Module']['EnderStorage']) {
    return array('status_code' => 403, 'message' => 'Le module enderstorage est désactivé.');
}
require_once('class/checkdroits.class.php');
require_once('class/enderstorages.class.php');

if (!Checkdroits::checkArgs($_POST,array('reserver' => true, 'id_joueur' => true, 'id_enderchest' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_enderchest'], 'enderstorage_tank')) {
    return array('status_code' => 404, 'message' => 'cette enderstoragetank n\'existe pas.');
}
if (!is_bool($_POST['reserver']) && $_POST['reserver'] != "true" && $_POST['reserver'] != "false" && $_POST['reserver'] != "1" && $_POST['reserver'] != "0") {
    $_POST['reserver'] = false;
}
if ($_POST['reserver']) {
    if (!Checkdroits::checkId($bddConnection, $_POST['id_joueur'], 'joueur')) {
        return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
    }
    Enderstorages::setEnderStorageChest($bddConnection,$_POST['id_enderchest'],$_POST['id_joueur'],date('Y-m-d H:i:s'));
    return array('status_code' => 200, 'message' => 'L\'enderstoragetank a bien été reservé.');
} else {
    Enderstorages::setEnderStorageChest($bddConnection,$_POST['id_enderchest'],null,null);
    return array('status_code' => 200, 'message' => 'L\'enderstoragetank a bien été libéré.');
}