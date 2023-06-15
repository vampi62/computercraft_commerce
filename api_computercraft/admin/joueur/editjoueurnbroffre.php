<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/joueurs.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useradmin' => false,'mdpadmin' => false, 'id_joueur' => false, 'nbr_offre' => false))) {
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
if (!Checkdroits::CheckId($bddConnection, $_GET['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if ($_GET['nbr_offre'] < 0) {
    return array('status_code' => 400, 'message' => 'Le nombre d\'offre ne peut pas être negatif.');
}
if ($_GET['nbr_offre'] > $_Serveur_['General']['nbr_offre_max']) {
    $_GET['nbr_offre'] = $_Serveur_['General']['nbr_offre_max'];
}
Joueurs::setJoueurnbrOffre($bddConnection, $_GET['id_joueur'], $_GET['nbr_offre']);
return array('status_code' => 200, 'message' => 'Le nombre d\'offre a bien ete modifie.');