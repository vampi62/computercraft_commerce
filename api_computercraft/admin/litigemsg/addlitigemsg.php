<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/litigemsgs.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_commande' => false, 'description' => false, 'id_status_litigemsg' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_commande'], 'commande')) {
    return array('status_code' => 404, 'message' => 'La commande n\'existe pas.');
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_status_litigemsg'], 'status_litigemsg')) {
    return array('status_code' => 404, 'message' => 'Le status n\'existe pas.');
}
if (strlen($_GET['description']) > $_Serveur_['MaxLengthChamps']['description']) {
    return array('status_code' => 413, 'message' => 'Le message est trop long.');
}
$newid = LitigeMsgs::addLitigeMsg($bddConnection,$_GET['id_commande'],$_GET['description'],$_GET['id_status_litigemsg']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newid));