<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/litigemsgs.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_litigemsg' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_litigemsg'], 'litigemsg')) {
    return array('status_code' => 404, 'message' => 'Le litigemsg n\'existe pas.');
}
LitigeMsgs::deleteLitigemsg($bddConnection, $_GET['id_litigemsg']);
return array('status_code' => 200, 'message' => 'Le litigemsg a bien ete supprime.');