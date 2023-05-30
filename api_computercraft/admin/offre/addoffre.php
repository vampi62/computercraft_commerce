<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/offres.class.php');

if(!Checkdroits::CheckArgs($_GET,array('useradmin' => false,'mdpadmin' => false, 'id_joueur' => false, 'id_compte' => true, 'id_adresse' => true, 'id_type_offre' => true, 'prix' => true, 'description' => true, 'nom' => true, 'stock' => true))) {
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
if(!Checkdroits::CheckId($bddConnection, $_GET['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if(!empty($_GET['id_compte']) && !Checkdroits::CheckId($bddConnection, $_GET['id_compte'], 'compte')) {
    return array('status_code' => 404, 'message' => 'Le compte n\'existe pas.');
}
if(!empty($_GET['id_adresse']) && !Checkdroits::CheckId($bddConnection, $_GET['id_adresse'], 'adresse')) {
    return array('status_code' => 404, 'message' => 'L\'adresse n\'existe pas.');
}
if(!empty($_GET['id_type_offre']) && !Checkdroits::CheckId($bddConnection, $_GET['id_type_offre'], 'type_offre')) {
    return array('status_code' => 404, 'message' => 'Le type d\'offre n\'existe pas.');
}
if (!is_numeric($_GET['prix'])) {
    return array('status_code' => 400, 'message' => 'Le prix n\'est pas un nombre.');
}
if (!is_numeric($_GET['stock'])) {
    return array('status_code' => 400, 'message' => 'Le stock n\'est pas un nombre.');
}
if($_GET['prix'] < 0) {
    return array('status_code' => 400, 'message' => 'Le prix ne peut pas etre negatif.');
}
if($_GET['stock'] < 0) {
    return array('status_code' => 400, 'message' => 'Le stock ne peut pas etre negatif.');
}
if (len($_GET['nom']) > $_Serveur_['General']['MaxLengthChamps']['nom']) {
    return array('status_code' => 400, 'message' => 'Le nom de l\'offre est trop long.');
}
if (len($_GET['description']) > $_Serveur_['General']['MaxLengthChamps']['description']) {
    return array('status_code' => 400, 'message' => 'La description est trop longue.');
}
Offres::addOffre($bddConnection,$_GET['id_joueur'],$_GET['id_compte'],$_GET['id_adresse'],$_GET['id_type_offre'],$_GET['prix'],$_GET['description'],$_GET['nom'],$_GET['stock']);
return array('status_code' => 200, 'message' => '');