<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/offres.class.php');

if(!Checkdroits::CheckArgss($_GET,array('useradmin' => false,'mdpadmin' => false, 'id_offre' => false, 'nom' => false))) {
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
if(!Checkdroits::CheckId($bddConnection, $_GET['id_offre'], 'offre')) {
    return array('status_code' => 404, 'message' => 'L\'offre n\'existe pas.');
}
if (len($_GET['nom']) > $_Serveur_['General']['MaxLengthChamps']['nom']) {
    return array('status_code' => 400, 'message' => 'Le nom de l\'offre est trop long.');
}
Offres::setNomOffre($bddConnection, $_GET['id_offre'], $_GET['nom']);
return array('status_code' => 200, 'message' => 'Le nom de l\'offre a bien ete modifie.');