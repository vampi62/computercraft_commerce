<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/comptes.class.php');

if (!Checkdroits::CheckArgs($_GET, array('pseudo' => false,'mdp' => false, 'nbr_offre' => false, 'id_compte' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$donneesJoueurUser = Joueurs::getJoueurbyPseudo($bddConnection, $_GET['pseudo']);
if (empty($donneesJoueurUser['pseudo_joueur'])) {
    return array('status_code' => 404, 'message' => 'Le compte useradmin n\'existe pas.');
}
if (!Checkdroits::CheckMdp($bddConnection, $_GET['pseudo'], $_GET['mdp'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
if (!is_numeric($_GET['nbr_offre'])) {
    return array('status_code' => 400, 'message' => 'Le nombre d\'offre doit etre un nombre.');
}
if ($_GET['nbr_offre'] <= $donneesJoueurUser['nbr_offre']) {
    return array('status_code' => 400, 'message' => 'Le nombre d\'offre ne peut pas etre inferieur au nombre actuel.');
}
if ($_GET['nbr_offre'] > $_Serveur_['General']['nbr_offre_max']) {
    $_GET['nbr_offre'] = $_Serveur_['General']['nbr_offre_max'];
}
$diff = $_GET['nbr_offre'] - $donneesJoueurUser['nbr_offre'];
$compte = Comptes::getcomptebyid($bddConnection, $_GET['id_compte']);

Joueurs::editJoueurNbrOffre($bddConnection, $_GET['pseudo'], $_GET['nbr_offre']);
return array('status_code' => 200, 'message' => 'Le nombre d\'offre a bien ete modifie.' ,'data' => array('pseudo' => $_GET['pseudo'], 'nbr_offre' => $_GET['nbr_offre']));