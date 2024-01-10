<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_joueur' => false, 'nbr_offre' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if ($_POST['nbr_offre'] < 0) {
    return array('status_code' => 400, 'message' => 'Le nombre d\'offre ne peut pas être negatif.');
}
if ($_POST['nbr_offre'] > $_Serveur_['General']['NbrOffreMax']) {
    $_POST['nbr_offre'] = $_Serveur_['General']['NbrOffreMax'];
}
$joueur = new Joueurs($bddConnection, $_POST['id_joueur']);
$joueur->setJoueurnbrOffre($_POST['nbr_offre']);
return array('status_code' => 200, 'message' => 'Le nombre d\'offre a bien ete modifie.');