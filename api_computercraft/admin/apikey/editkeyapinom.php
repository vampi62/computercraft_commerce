<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/apikeys.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useradmin' => false,'mdpadmin' => false, 'id_apikey' => false, 'nom' => false))) {
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
if (!Checkdroits::CheckId($bddConnection, $_GET['id_apikey'], 'apikey')) {
    return array('status_code' => 404, 'message' => 'l\'apikey n\'existe pas.');
}
$idJoueur = apikeys::getapikeyById($bddConnection, $_GET['id_apikey'])['id_joueur'];
if (count(apikeys::getapikeyByNom($bddConnection,$idJoueur . '-' . $_GET['nom']))) {
    return array('status_code' => 404, 'message' => 'Le nom de l\'apikey existe deja.');
}
if (strlen($_GET['nom']) > $_Serveur_['MaxLengthChamps']['nom']) {
    return array('status_code' => 413, 'message' => 'Le nom de l\'apikey est trop long.');
}
$apiKey = new apikeys($bddConnection, $_GET['id_apikey']);
$apiKey->setapikeyNom($_GET['nom'], $idJoueur);
return array('status_code' => 200, 'message' => 'Le nom de l\'apikey a bien ete modifie.');