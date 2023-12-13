<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/comptes.class.php');

if (!Checkdroits::checkArgs($_GET,array('nbr_offre' => false, 'id_compte' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => false,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if ($_GET['nbr_offre'] <= 0) {
    return array('status_code' => 400, 'message' => 'Le nombre d\'offre a ajouter ne peut pas être negatif ou nul.');
}
$joueur = Joueurs::getJoueurById($bddConnection, $sessionUser['idLogin']);
$new_nbr_offre = $_GET['nbr_offre'] + $joueur['max_offres_joueur'];
if ($new_nbr_offre > $_Serveur_['General']['nbr_offre_max']) {
    $new_nbr_offre = $_Serveur_['General']['nbr_offre_max'];
    $_GET['nbr_offre'] = $new_nbr_offre - $joueur['max_offres_joueur'];
}
if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_GET['id_compte'], 'compte', 'getcomptes')) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
}
# compte a bien les fond a prelever
$compte = Comptes::getCompteById($bddConnection, $_GET['id_compte']);
$prix_offres = $_GET['nbr_offre'] * $_Serveur_['General']['prix_offre'];
if ($compte['fonds'] < $prix_offres) {
    return array('status_code' => 400, 'message' => 'Le compte n\'a pas assez de fonds pour effectuer cette action.');
}
# on preleve les fonds
Comptes::setCompteFonds($bddConnection, $_GET['id_compte'], $compte['fonds'] - $prix_offres);
Joueurs::setJoueurnbrOffre($bddConnection, $sessionUser['idLogin'], $new_nbr_offre + $joueur['max_offres_joueur']);
return array('status_code' => 200, 'message' => 'Le nombre d\'offre a bien ete modifie.', 'data' => array('nbr_offre' => $new_nbr_offre + $joueur['max_offres_joueur']));