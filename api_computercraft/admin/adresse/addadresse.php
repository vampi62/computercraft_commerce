<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/adresses.class.php');

if(!Checkdroits::CheckArgs($_GET,array('useradmin' => false,'mdpadmin' => false, 'id_joueur' => false, 'coo' => false, 'nom' => false, 'description' => false, 'id_type_adresse' => false, 'id_livreur' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$donneesJoueurUserAdmin = Joueurs::getJoueurbyPseudo($bddConnection, $_GET['useradmin']);
if(empty($donneesJoueurUserAdmin['pseudo'])) {
    return array('status_code' => 404, 'message' => 'Le compte useradmin n\'existe pas.');
}
if(!Checkdroits::CheckMdp($bddConnection, $_GET['useradmin'], $_GET['mdpadmin'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
if(!Checkdroits::CheckRole($bddConnection, $_GET['useradmin'], array('admin'))) {
    return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['id_type_adresse'], 'type_adresse')) {
    return array('status_code' => 404, 'message' => 'Le type n\'existe pas.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (!empty($_GET['id_livreur']) && !Checkdroits::CheckId($bddConnection, $_GET['id_livreur'], 'livreur')) {
    return array('status_code' => 404, 'message' => 'Le livreur n\'existe pas.');
}
if (len($_GET['nom']) > $_Serveur_['General']['MaxLengthChamps']['nom']) {
    return array('status_code' => 400, 'message' => 'Le nom de l\'adresse est trop long.');
}
if (len($_GET['description']) > $_Serveur_['General']['MaxLengthChamps']['description']) {
    return array('status_code' => 400, 'message' => 'La description est trop longue.');
}
if (len($_GET['coo']) > $_Serveur_['General']['MaxLengthChamps']['coo']) {
    return array('status_code' => 400, 'message' => 'Les coordonnees sont trop longues.');
}
Adresses::addAdresse($bddConnection, $_GET['id_joueur'], $_GET['coo'], $_GET['nom'], $_GET['description'], $_GET['id_type_adresse'], $_GET['id_livreur']);
return array('status_code' => 200, 'message' => 'L\'adresse a bien ete ajoutee.');