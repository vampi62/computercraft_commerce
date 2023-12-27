<?php
require_once('class/checkdroits.class.php');
require_once('class/commandes.class.php');
require_once('class/apikeys.class.php');

if (!Checkdroits::checkArgs($_GET,array('id_commande' => false, 'id_type_commande' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_GET,array('apikey' => true,'user' => true));
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
$commande = Commandes::getCommandeById($bddConnection, $_GET['id_commande']);
if (empty($commande)) {
    return array('status_code' => 404, 'message' => 'La commande n\'existe pas.');
}
if (!Checkdroits::checkId($bddConnection, $_GET['id_type_commande'], 'type_commande')) {
    return array('status_code' => 404, 'message' => 'Le type n\'existe pas.');
}
$permitAction = false;
if ($sessionUser['isApi']) {
    $apikey = Apikeys::getApiKeyById($bddConnection, $sessionUser['idLogin']);
    if (Checkdroits::checkRole($bddConnection, $apikey['pseudo_joueur'], array('terminal','traitement'))) {
        if (Checkdroits::checkCheminTypeCommande($bddConnection, $_GET['id_type_commande'], $commande['id_type_commande'], 'admin')) {
            $permitAction = true;
        }
    }
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_offre'], 'offre', 'vendeurEditStatusCommande', $sessionUser['isApi'])) {
    if (Checkdroits::checkCheminTypeCommande($bddConnection, $_GET['id_type_commande'], $commande['id_type_commande'], 'vendeur')) {
        $permitAction = true;
    }
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_compte_vendeur'], 'compte', 'vendeurEditStatusCommande', $sessionUser['isApi'])) {
    if (Checkdroits::checkCheminTypeCommande($bddConnection, $_GET['id_type_commande'], $commande['id_type_commande'], 'vendeur')) {
        $permitAction = true;
    }
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_adresse_vendeur'], 'adresse', 'vendeurEditStatusCommande', $sessionUser['isApi'])) {
    if (Checkdroits::checkCheminTypeCommande($bddConnection, $_GET['id_type_commande'], $commande['id_type_commande'], 'vendeur')) {
        $permitAction = true;
    }
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_livreur'], 'livreur', 'livreurEditStatusCommande', $sessionUser['isApi'])) {
    if (Checkdroits::checkCheminTypeCommande($bddConnection, $_GET['id_type_commande'], $commande['id_type_commande'], 'livreur')) {
        $permitAction = true;
    }
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_compte_client'], 'compte', 'clientEditStatusCommande', $sessionUser['isApi'])) {
    if (Checkdroits::checkCheminTypeCommande($bddConnection, $_GET['id_type_commande'], $commande['id_type_commande'], 'client')) {
        $permitAction = true;
    }
}
if (!$permitAction && Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $commande['id_adresse_client'], 'adresse', 'clientEditStatusCommande', $sessionUser['isApi'])) {
    if (Checkdroits::checkCheminTypeCommande($bddConnection, $_GET['id_type_commande'], $commande['id_type_commande'], 'client')) {
        $permitAction = true;
    }
}
if (!$permitAction) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas les droits pour effectuer cette action.');
}
$commande = new Commandes($bddConnection, $_GET['id_commande']);
$suivi = "";
switch ($_GET['id_type_commande']) {
    case 2: // (vendeur) validation refusée par le vendeur
        $suivi = $sessionUser['pseudoLogin'].' a refusé la commande.';
        break;
    case 3: // (vendeur) validation acceptée par le vendeur --> paiement en attente
        $suivi = $sessionUser['pseudoLogin'].' a accepté la commande.';
        break;
    case 4: // (banque) paiement refusé par la banque
        $suivi = $sessionUser['pseudoLogin'].' a refusé le paiement.';
        break;
    case 5: // (banque) paiement accepté par la banque --> preparation en cours
        $suivi = $sessionUser['pseudoLogin'].' a accepté le paiement.';
        break;
    case 6: // (vendeur) en attente de livreur
        $suivi = $sessionUser['pseudoLogin'].' a mis la commande en attente de livreur.';
        break;
    case 7: // (vendeur) livraison en cours
        $suivi = $sessionUser['pseudoLogin'].' a mis la commande en livraison.';
        break;
    case 8: // (livreur) livraison en pause
        $suivi = $sessionUser['pseudoLogin'].' a mis la commande en pause.';
        break;
    case 9: // (livreur) livraison en point retrait
        $suivi = $sessionUser['pseudoLogin'].' a mis la commande en point retrait.';
        break;
    case 10: // (livreur) livraison effectuée
        $suivi = $sessionUser['pseudoLogin'].' a mis la commande en livraison effectuée.';
        $commande->setCommandeDateLivraison($_GET['date']);
        break;
    case 11: // (client) validée par le client
        $suivi = $sessionUser['pseudoLogin'].' a validé la commande.';
        break;
    case 12: // (client) refusée par le client
        $suivi = $sessionUser['pseudoLogin'].' a refusé la commande.';
        break;
    case 13: // (client) commande en litige
        $suivi = $sessionUser['pseudoLogin'].' a mis la commande en litige.';
        break;
    case 14: // (client) commande annulée
        $suivi = $sessionUser['pseudoLogin'].' a annulé la commande.';
        break;
    case 16: // (vendeur) commande direct terminer
        $suivi = $sessionUser['pseudoLogin'].' a terminé la commande direct.';
        break;
}
$commande->setCommandeSuivi($suivi, $_Serveur_['General']['case_ligne_suite']);
$commande->setCommandeStatus($_GET['id_type_commande']);
return array('status_code' => 200, 'message' => '');