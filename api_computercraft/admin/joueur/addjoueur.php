<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_GET,array('pseudo' => false, 'mdp' => false, 'email' => false, 'id_type_role' => false, 'nbr_offre' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!empty(Joueurs::getJoueurByPseudo($bddConnection, $_GET['pseudo']))) {
    return array('status_code' => 404, 'message' => 'Le pseudo est deja pris.');
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_type_role'], 'type_role')) {
    return array('status_code' => 404, 'message' => 'Le role n\'existe pas.');
}
if (!Checkdroits::checkPasswordSecu($_GET['mdp'])) {
    return array('status_code' => 400, 'message' => 'Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre.');
}
if (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
    return array('status_code' => 413, 'message' => 'L\'adresse mail est invalide.');
}
if (strlen($_GET['pseudo']) > $_Serveur_['MaxLengthChamps']['Pseudo']) {
    return array('status_code' => 413, 'message' => 'Le pseudo est trop long.');
}
if (strlen($_GET['email']) > $_Serveur_['MaxLengthChamps']['Email']) {
    return array('status_code' => 413, 'message' => 'L\'email est trop long.');
}
if (empty($_GET['nbr_offre']) || $_GET['nbr_offre'] <= 0) {
    if ($_Serveur_['General']['NbrOffreDefaut'] <= 0) {
        $_GET['nbr_offre'] = 0;
    } else {
        $_GET['nbr_offre'] = $_Serveur_['General']['NbrOffreDefaut'];
    }
} else {
    if ($_GET['nbr_offre'] > $_Serveur_['General']['NbrOffreMax']) {
        $_GET['nbr_offre'] = $_Serveur_['General']['NbrOffreMax'];
    }
}
$newJoueur = new Joueurs($bddConnection);
$newJoueur->addJoueur($_GET['pseudo'], $_GET['email'], $_GET['mdp'], $_GET['nbr_offre'], $_GET['id_type_role']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newJoueur->getId()));