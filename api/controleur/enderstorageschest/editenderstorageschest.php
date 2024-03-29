<?php
if (!$_Serveur_['Module']['EnderStorage']) {
    return array('status_code' => 403, 'message' => 'Le module enderstorage est désactivé.');
}
require_once('class/checkdroits.class.php');
require_once('class/enderstorages.class.php');

if (!Checkdroits::checkArgs($_POST,array('reserver' => true, 'id_enderstorageschest' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => false,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_enderstorageschest'], 'enderstorage_chest')) {
    return array('status_code' => 404, 'message' => 'cette enderstoragechest n\'existe pas.');
}
$_POST['reserver'] = $_POST['reserver'] == "true" || $_POST['reserver'] == "1" ? true : false;
$enderchest = Enderstorages::getEnderStorageChestById($bddConnection,$_POST['id_enderstorageschest'], true);
if ($_POST['reserver']) {
    if ($enderchest['id_joueur'] != null) {
        return array('status_code' => 403, 'message' => 'L\'enderstoragechest est déjà reservé.');
    }
    Enderstorages::setEnderStorageChest($bddConnection,$_POST['id_enderstorageschest'],$sessionUser['idLogin'],date('Y-m-d H:i:s'));
    return array('status_code' => 200, 'message' => 'L\'enderstoragechest a bien été reservé.');
} else {
    if ($enderchest['id_joueur'] != $sessionUser['idLogin']) {
        return array('status_code' => 403, 'message' => 'Vous ne pouvez pas libérer un enderstoragechest que vous n\'avez pas reservé.');
    }
    Enderstorages::setEnderStorageChest($bddConnection,$_POST['id_enderstorageschest'],null,null);
    return array('status_code' => 200, 'message' => 'L\'enderstoragechest a bien été libéré.');
}