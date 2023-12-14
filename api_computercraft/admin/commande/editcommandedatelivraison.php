<?php
require_once('class/checkdroits.class.php');
require_once('class/commandes.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_commande' => false, 'date' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_commande'], 'commande')) {
    return array('status_code' => 404, 'message' => 'La commande n\'existe pas.');
}
if (!empty($_GET['date'])) {
    if (!(strtotime($_GET['date']) !== false)) {
        return array('status_code' => 400, 'message' => 'La date est invalide.');
    }
} else {
    $_GET['date'] = null;
}
$suivi = $sessionAdmin['pseudoLogin'].' a changer la date de livraison a '. $_GET['date'] . ' via panel admin.';
$commande = new Commandes($bddConnection, $_GET['id_commande']);
$commande->setCommandeSuivi($suivi, $_Serveur_['General']['case_ligne_suite']);
$commande->setCommandeDateLivraison($_GET['date']);
return array('status_code' => 200, 'message' => '');