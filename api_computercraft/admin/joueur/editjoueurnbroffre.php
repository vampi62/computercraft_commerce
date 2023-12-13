<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_joueur' => false, 'nbr_offre' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if ($_GET['nbr_offre'] < 0) {
    return array('status_code' => 400, 'message' => 'Le nombre d\'offre ne peut pas être negatif.');
}
if ($_GET['nbr_offre'] > $_Serveur_['General']['nbr_offre_max']) {
    $_GET['nbr_offre'] = $_Serveur_['General']['nbr_offre_max'];
}
$joueur = new Joueurs($bddConnection, $_GET['id_joueur']);
$joueur->setJoueurnbrOffre($_GET['nbr_offre']);
return array('status_code' => 200, 'message' => 'Le nombre d\'offre a bien ete modifie.');