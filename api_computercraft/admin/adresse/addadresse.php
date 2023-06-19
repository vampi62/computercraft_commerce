<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/adresses.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useradmin' => false,'mdpadmin' => false, 'id_joueur' => false, 'coo' => false, 'nom' => false, 'description' => false, 'id_type_adresse' => false, 'id_livreur' => true))) {
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
if (!Checkdroits::CheckId($bddConnection, $_GET['id_type_adresse'], 'type_adresse')) {
    return array('status_code' => 404, 'message' => 'Le type n\'existe pas.');
}
if (!Checkdroits::CheckId($bddConnection, $_GET['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (!empty($_GET['id_livreur']) && !Checkdroits::CheckId($bddConnection, $_GET['id_livreur'], 'livreur')) {
    return array('status_code' => 404, 'message' => 'Le livreur n\'existe pas.');
}
// si il y a un livreur alors le type d'adresse doit etre un point de livraison
if (!empty($_GET['id_livreur'])) {
    if (!$_GET['id_type_adresse'] == 2) {
        return array('status_code' => 400, 'message' => 'Le livreur ne peut etre defini que pour un point de livraison.');
    }
}
if (strlen($_GET['nom']) > $_Serveur_['MaxLengthChamps']['nom']) {
    return array('status_code' => 400, 'message' => 'Le nom de l\'adresse est trop long.');
}
if (strlen($_GET['description']) > $_Serveur_['MaxLengthChamps']['description']) {
    return array('status_code' => 400, 'message' => 'La description est trop longue.');
}
if (strlen($_GET['coo']) > $_Serveur_['MaxLengthChamps']['coo']) {
    return array('status_code' => 400, 'message' => 'Les coordonnees sont trop longues.');
}
$newid = Adresses::addAdresse($bddConnection, $_GET['id_joueur'], $_GET['coo'], $_GET['nom'], $_GET['description'], $_GET['id_type_adresse'], $_GET['id_livreur']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newid));