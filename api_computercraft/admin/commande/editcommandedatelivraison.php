<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/commandes.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useradmin' => false,'mdpadmin' => false, 'id_commande' => false, 'date' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$donneesJoueurUserAdmin = Joueurs::getJoueurByPseudo($bddConnection, $_GET['useradmin']);
if (empty($donneesJoueurUserAdmin['pseudo_joueur'])) {
    return array('status_code' => 404, 'message' => 'Le compte useradmin n\'existe pas.');
}
if (!Checkdroits::CheckMdp($bddConnection, $_GET['useradmin'], $_GET['mdpadmin'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
if (!Checkdroits::CheckRole($bddConnection, $_GET['useradmin'], array('admin'))) {
    return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
}
if (!Checkdroits::CheckId($bddConnection, $_GET['id_commande'], 'commande')) {
    return array('status_code' => 404, 'message' => 'La commande n\'existe pas.');
}
if (!empty($_GET['date'])) {
    if (!(strtotime($_GET['date']) !== false)) {
        return array('status_code' => 400, 'message' => 'La date est invalide.');
    }
} else {
    $_GET['date'] = null;
}
$suivi = $donneesJoueurUserAdmin['pseudo_joueur'].' a changer la date de livraison a '. $_GET['date'] . ' via panel admin.';
$commande = new Commandes($bddConnection, $_GET['id_commande']);
$commande->setCommandeSuivi($suivi, $_Serveur_['General']['case_ligne_suite']);
$commande->setCommandeDateLivraison($_GET['date']);
return array('status_code' => 200, 'message' => '');