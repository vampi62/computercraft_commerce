<?php
if (!$_Serveur_['Module']['EnderStorage']) {
    return array('status_code' => 403, 'message' => 'Le module enderstorage est désactivé.');
}
require_once('class/checkdroits.class.php');
require_once('class/enderstorages.class.php');

if (!Checkdroits::checkArgs($_POST,array('reserver' => true, 'id_endertank' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => false,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_endertank'], 'enderstorage_tank')) {
    return array('status_code' => 404, 'message' => 'cette enderstoragetank n\'existe pas.');
}
if (!is_bool($_POST['reserver']) && $_POST['reserver'] != "true" && $_POST['reserver'] != "false" && $_POST['reserver'] != "1" && $_POST['reserver'] != "0") {
    $_POST['reserver'] = false;
}
$endertank = Enderstorages::getEnderStorageTankById($bddConnection,$_POST['id_endertank']);
if ($_POST['reserver']) {
    if ($endertank['id_joueur'] != null) {
        return array('status_code' => 403, 'message' => 'L\'enderstoragetank est déjà reservé.');
    }
    Enderstorages::setEnderStorageTank($bddConnection,$_POST['id_endertank'],$sessionUser['idLogin'],date('Y-m-d H:i:s'));
    return array('status_code' => 200, 'message' => 'L\'enderstoragetank a bien été reservé.');
} else {
    if ($endertank['id_joueur'] != $sessionUser['idLogin']) {
        return array('status_code' => 403, 'message' => 'Vous ne pouvez pas libérer un enderstoragetank que vous n\'avez pas reservé.');
    }
    Enderstorages::setEnderStorageTank($bddConnection,$_POST['id_endertank'],null,null);
    return array('status_code' => 200, 'message' => 'L\'enderstoragetank a bien été libéré.');
}