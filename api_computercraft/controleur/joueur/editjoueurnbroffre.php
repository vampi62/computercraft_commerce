<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/comptes.class.php');
require_once('class/transactions.class.php');

if (!Checkdroits::checkArgs($_POST,array('nbr_offre' => false, 'id_compte' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => false,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
if ($_POST['nbr_offre'] <= 0) {
    return array('status_code' => 400, 'message' => 'Le nombre d\'offre a ajouter ne peut pas être negatif ou nul.');
}
$joueur = new Joueurs($bddConnection, $sessionUser['idLogin']);
$nbrOffreJoueur = $joueur->getJoueurNbrOffre();
$new_nbr_offre = $_POST['nbr_offre'] + $nbrOffreJoueur;
if ($new_nbr_offre > $_Serveur_['General']['NbrOffreMax']) {
    $new_nbr_offre = $_Serveur_['General']['NbrOffreMax'];
    $_POST['nbr_offre'] = $new_nbr_offre - $nbrOffreJoueur;
}
if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_POST['id_compte'], 'compte', 'getcomptes')) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
}
# compte a bien les fond a prelever
$compte = new Comptes($bddConnection, $_POST['id_compte']);
$prix_offres = $_POST['nbr_offre'] * $_Serveur_['General']['PrixOffre'];
if ($compte->getSolde() < $prix_offres) {
    return array('status_code' => 400, 'message' => 'Le compte n\'a pas assez de fonds pour effectuer cette action.');
}
# on preleve les fonds
$compte->setCompteSolde($compte->getSolde() - $prix_offres);

# on ajoute la transaction
Transaction::addTransaction($bddConnection, $_POST['id_compte'], null, null, $prix_offres, 'achat offre', 'Achat de ' . $_POST['nbr_offre'] . ' offres.',4);

# on ajoute les offres au joueur
$joueur->setJoueurnbrOffre($bddConnection, $sessionUser['idLogin'], $new_nbr_offre);
return array('status_code' => 200, 'message' => 'Le nombre d\'offre a bien ete modifie.', 'data' => array('nbr_offre' => $new_nbr_offre));