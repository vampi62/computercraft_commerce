<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');


if(!Checkdroits::CheckArgs($_GET,array('useraction' => false,'mdp' => false, 'pseudo' => false, 'newmdp' => false, 'email' => false, 'role' => false, 'nbr_offre' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$donneesJoueurUserAction = Joueurs::getJoueurbyPseudo($bddConnection, $_GET['useraction']);
if(empty($donneesJoueurUserAction['pseudo'])) {
    return array('status_code' => 404, 'message' => 'Le compte useraction n\'existe pas.');
}
if(!Checkdroits::CheckMdp($bddConnection, $_GET['useraction'], $_GET['mdp'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
if(!Checkdroits::CheckRole($bddConnection, $_GET['useraction'], array('admin'))) {
    return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
}
if(!Checkdroits::CheckId($bddConnection, $_GET['id'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if(Joueurs::getJoueurbyPseudo($bddConnection, $_GET['pseudo'])['id_joueur'] != null) {
    return array('status_code' => 404, 'message' => 'Le pseudo est deja pris.');
}
if (!Checkdroits::CheckPasswordSecu($_GET['newmdp'])) {
    return array('status_code' => 400, 'message' => 'Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre.');
}
if(!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
    return array('status_code' => 400, 'message' => 'L\'adresse mail est invalide.');
}
if (empty($nbr_offre) || $nbr_offre < 0) {
    $nbr_offre = 0;
} else {
    if ($nbr_offre > $_Serveur_['General']['nbr_offre_max']) {
        $nbr_offre = $_Serveur_['General']['nbr_offre_max'];
    }
}
Joueurs::addJoueur($bddConnection, $_GET['pseudo'], $_GET['email'], $_GET['newmdp'], $nbr_offre, $_GET['role']);
return array('status_code' => 200, 'message' => 'Le joueur a bien ete ajoute.');