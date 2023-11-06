<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useruser' => false,'mdpuser' => false, 'new_nbr_offre' => false, 'id_compte' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$joueur = Joueurs::getJoueurByPseudo($bddConnection, $_GET['useruser']);
if (empty($joueur)) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (!Checkdroits::CheckMdp($bddConnection, $_GET['useradmin'], $_GET['mdpadmin'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
if (!Checkdroits::CheckRole($bddConnection, $_GET['useradmin'], array('admin'))) {
    return array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
}
if (!Checkdroits::CheckId($bddConnection, $_GET['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if ($_GET['new_nbr_offre'] < 0) {
    return array('status_code' => 400, 'message' => 'Le nombre d\'offre a ajouter ne peut pas être negatif.');
}
$_GET['new_nbr_offre'] = $_GET['new_nbr_offre'] + $joueur['max_offres_joueur'];
if ($_GET['new_nbr_offre'] > $_Serveur_['General']['nbr_offre_max']) {
    $_GET['new_nbr_offre'] = $_Serveur_['General']['nbr_offre_max'];
}
Joueurs::setJoueurnbrOffre($bddConnection, $_GET['id_joueur'], $_GET['new_nbr_offre']);
return array('status_code' => 200, 'message' => 'Le nombre d\'offre a bien ete modifie.', 'data' => array('nbr_offre' => $_GET['new_nbr_offre']));