<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/adresses.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useradmin' => false,'mdpadmin' => false, 'id_adresse' => false, 'id_livreur' => true))) {
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
if (!Checkdroits::CheckId($bddConnection, $_GET['id_adresse'], 'adresse')) {
    return array('status_code' => 404, 'message' => 'L\'adresse n\'existe pas.');
}
// le type d'adresse doit etre un point de livraison pour pouvoir definir un livreur
if (!empty($_GET['id_livreur'])) {
    $adresse = Adresses::getAdresseById($bddConnection, $_GET['id_adresse']);
    if (!$adresse['id_type_adresse'] == 2) {
        return array('status_code' => 400, 'message' => 'Le livreur ne peut etre defini que pour un point de livraison.');
    }
}
if (!empty($_GET['id_livreur']) && !Checkdroits::CheckId($bddConnection, $_GET['id_livreur'], 'livreur')) {
    return array('status_code' => 404, 'message' => 'Le livreur n\'existe pas.');
}
Adresses::setAdresseLivreur($bddConnection, $_GET['id_adresse'], $_GET['id_livreur']);
return array('status_code' => 200, 'message' => '');