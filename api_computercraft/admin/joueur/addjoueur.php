<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');


if (!Checkdroits::CheckArgs($_GET,array('useradmin' => false,'mdpadmin' => false, 'pseudo' => false, 'mdp' => false, 'email' => false, 'id_type_role' => false, 'nbr_offre' => true))) {
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
if (!empty(Joueurs::getJoueurbyPseudo($bddConnection, $_GET['pseudo']))) {
    return array('status_code' => 404, 'message' => 'Le pseudo est deja pris.');
}
if (!Checkdroits::CheckId($bddConnection, $_GET['id_type_role'], 'type_role')) {
    return array('status_code' => 404, 'message' => 'Le role n\'existe pas.');
}
if (!Checkdroits::CheckPasswordSecu($_GET['mdp'])) {
    return array('status_code' => 400, 'message' => 'Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre.');
}
if (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
    return array('status_code' => 413, 'message' => 'L\'adresse mail est invalide.');
}
if (strlen($_GET['pseudo']) > $_Serveur_['MaxLengthChamps']['pseudo']) {
    return array('status_code' => 413, 'message' => 'Le pseudo est trop long.');
}
if (strlen($_GET['email']) > $_Serveur_['MaxLengthChamps']['email']) {
    return array('status_code' => 413, 'message' => 'L\'email est trop long.');
}
if (empty($_GET['nbr_offre']) || $_GET['nbr_offre'] <= 0) {
    if ($_Serveur_['General']['nbr_offre_defaut'] <= 0) {
        $_GET['nbr_offre'] = 0;
    } else {
        $_GET['nbr_offre'] = $_Serveur_['General']['nbr_offre_defaut'];
    }
} else {
    if ($_GET['nbr_offre'] > $_Serveur_['General']['nbr_offre_max']) {
        $_GET['nbr_offre'] = $_Serveur_['General']['nbr_offre_max'];
    }
}
Joueurs::addJoueur($bddConnection, $_GET['pseudo'], $_GET['email'], $_GET['mdp'], $_GET['nbr_offre'], $_GET['id_type_role']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newid));