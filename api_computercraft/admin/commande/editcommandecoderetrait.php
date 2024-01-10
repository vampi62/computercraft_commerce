<?php
require_once('class/checkdroits.class.php');
require_once('class/commandes.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_commande' => false, 'code_retrait_commande' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_commande'], 'commande')) {
    return array('status_code' => 404, 'message' => 'La commande n\'existe pas.');
}
if (!Checkdroits::checkPasswordSecu($_POST['code_retrait_commande'])) {
    return array('status_code' => 400, 'message' => 'Le code de retrait n\'est pas securise.');
}
if (strlen($_POST['code_retrait_commande']) > $_Serveur_['MaxLengthChamps']['Code']) {
    return array('status_code' => 413, 'message' => 'Le code retrait est trop long.');
}
$commande = new Commandes($bddConnection, $_POST['id_commande']);
$commande->setCommandeCodeRetrait($_POST['code_retrait_commande']);
return array('status_code' => 200, 'message' => '');