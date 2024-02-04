<?php
require_once('class/checkdroits.class.php');
require_once('class/litigemsgs.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_litigemsg' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_litigemsg'], 'msg_litige')) {
    return array('status_code' => 404, 'message' => 'Le litigemsg n\'existe pas.');
}
LitigeMsgs::deleteLitigemsg($bddConnection, $_POST['id_litigemsg']);
return array('status_code' => 200, 'message' => 'Le litigemsg a bien ete supprime.');