<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/livreurs.class.php');
require_once('class/comptes.class.php');
require_once('class/adresses.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useradmin' => false,'mdpadmin' => false, 'id_joueur' => false, 'id_compte' => false, 'id_adresse' => false, 'nom' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$donneesJoueurUserAdmin = Joueurs::getJoueurbyPseudo($bddConnection, $_GET['useradmin']);
if (empty($donneesJoueurUserAdmin['pseudo_joueur'])) {
    return array('status_code' => 404, 'message' => 'Le compte useradmin n\'existe pas.');
}
if (!Checkdroits::CheckMdp($bddConnection, $_GET['useradmin'], $_GET['mdpadmin'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
if (!Checkdroits::CheckRole($bddConnection, $_GET['useradmin'], array('admin'))) {
    return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
}
if (!Checkdroits::CheckId($bddConnection, $_GET['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (!Checkdroits::CheckId($bddConnection, $_GET['id_compte'], 'compte')) {
    return array('status_code' => 404, 'message' => 'Le compte n\'existe pas.');
}
// le type de compte doit etre un compte entreprise_livreur pour pouvoir etre defini comme livreur
if (!empty($_GET['id_compte'])) {
    $compte = Comptes::getCompteById($bddConnection, $_GET['id_compte']);
    if (!$compte['id_type_compte'] == 2) {
        return array('status_code' => 400, 'message' => 'Le type de compte n\'est pas valide pour un livreur.');
    }
}
if (!Checkdroits::CheckId($bddConnection, $_GET['id_adresse'], 'adresse')) {
    return array('status_code' => 404, 'message' => 'L\'adresse n\'existe pas.');
}
// le type d'adresse doit etre un point relais pour pouvoir etre defini comme adresse par defait du livreur
if (!empty($_GET['id_adresse'])) {
    $adresse = Adresses::getAdresseById($bddConnection, $_GET['id_adresse']);
    if (!$adresse['id_type_adresse'] == 2) {
        return array('status_code' => 400, 'message' => 'Le type d\'adresse n\'est pas valide pour un livreur.');
    }
}
if (strlen($_GET['nom']) > $_Serveur_['MaxLengthChamps']['nom']) {
    return array('status_code' => 413, 'message' => 'Le nom du livreur est trop long.');
}
$newid = Livreurs::addLivreur($bddConnection, $_GET['id_joueur'], $_GET['id_compte'], $_GET['id_adresse'], $_GET['nom']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newid));