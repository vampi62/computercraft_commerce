<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/offres.class.php');

if(!Checkdroits::CheckArgs($_GET,array('useraction' => false,'mdp' => false, 'id' => false, 'id_compte' => true, 'id_adresse' => true, 'id_type_offre' => true, 'prix_offre' => true, 'description_offre' => true, 'nom_offre' => true, 'stock_offre' => true))) {
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
if(!empty($_GET['id_compte']) && !Checkdroits::CheckId($bddConnection, $_GET['id_compte'], 'compte')) {
    return array('status_code' => 404, 'message' => 'Le compte n\'existe pas.');
}
if(!empty($_GET['id_adresse']) && !Checkdroits::CheckId($bddConnection, $_GET['id_adresse'], 'adresse')) {
    return array('status_code' => 404, 'message' => 'L\'adresse n\'existe pas.');
}
if(!empty($_GET['id_type_offre']) && !Checkdroits::CheckId($bddConnection, $_GET['id_type_offre'], 'type_offre')) {
    return array('status_code' => 404, 'message' => 'Le type d\'offre n\'existe pas.');
}
if($_GET['prix_offre'] < 0) {
    return array('status_code' => 400, 'message' => 'Le prix ne peut pas etre negatif.');
}
if($_GET['stock_offre'] < 0) {
    return array('status_code' => 400, 'message' => 'Le stock ne peut pas etre negatif.');
}
Offres::addOffre($bddConnection,$_GET['id'],$_GET['id_compte'],$_GET['id_adresse'],$_GET['id_type_offre'],$_GET['prix_offre'],$_GET['description_offre'],$_GET['nom_offre'],$_GET['stock_offre']);
return array('status_code' => 200, 'message' => '');