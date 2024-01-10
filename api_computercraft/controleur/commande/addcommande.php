<?php
require_once('class/checkdroits.class.php');
require_once('class/commandes.class.php');
require_once('class/adresses.class.php');
require_once('class/comptes.class.php');
require_once('class/offres.class.php');
require_once('class/keypays.class.php');

if (!Checkdroits::checkArgs($_POST,array('nom' => false, 'description' => false, 'id_adresse_client' => false, 'id_offre' => false, 'id_compte_client' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$quant = 0;
$prixu = 0;
$frait = 0;
$methodecommande = 0;
$offre = Offres::getOffreById($bddConnection, $_POST['id_offre'], true);
if (empty($offre['id_offre'])) {
    return array('status_code' => 404, 'message' => 'L\'offre n\'existe pas ou n\'est pas active.');
}
if (Checkdroits::checkArgs($_POST,array('id_keypay' => false), true)) {
    $keypay = Keypays::getKeypayById($bddConnection, $_POST['id_keypay']);
    if (empty($keypay['id_keypay'])) {
        return array('status_code' => 404, 'message' => 'La keypay n\'existe pas.');
    }
    $quant = $keypay['quantite_keypay'];
    $prixu = $keypay['prix_unitaire_keypay'];
    $frait = 0;
    $methodecommande = 1;
    if ($offre['prix_offre'] != $prixu) {
        return array('status_code' => 400, 'message' => 'Le prix unitaire de la keypay ne correspond pas au prix de l\'offre.');
    }
} elseif (Checkdroits::checkArgs($_POST,array('quant' => false, 'frait' => false, 'prixu' => false), true)) {
    $quant = $_POST['quant'];
    $frait = $_POST['frait'];
    $prixu = $_POST['prixu'];
    $methodecommande = 2;
    if (!is_numeric($quant)) {
        return array('status_code' => 400, 'message' => 'La quantite doit être un nombre.');
    }
    if (!is_numeric($frait)) {
        return array('status_code' => 400, 'message' => 'Les frais de port doivent être un nombre.');
    }
    if ($quant <= 0) {
        return array('status_code' => 400, 'message' => 'La quantite doit être superieur a 0.');
    }
    if ($frait <= 0) {
        return array('status_code' => 400, 'message' => 'Les frais de port doivent être superieur ou egal a 0.');
    }
} else {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
if ($offre['prix_offre'] != $prixu) {
    return array('status_code' => 400, 'message' => 'Le prix unitaire ne correspond pas au prix de l\'offre.');
}
$sessionUser = Checkdroits::checkMode($bddConnection,$_POST,array('apikey' => true,'user' => true), true);
if (isset($sessionUser['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionUser; // error
}
// si pas de retour alors l'offre n'existe pas ou est inactive
if ($sessionUser['isApi']) {
    if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $sessionUser['idLogin'], 'apikey', 'addCommandeViaApiKey', $sessionUser['isApi'])) {
        return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
    }
}
if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_POST['id_adresse_client'], 'adresse', 'addAdresseToCommande', $sessionUser['isApi'])) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
}
$adresse = Adresses::getAdresseById($bddConnection, $_POST['id_adresse_client']);
if (!$adresse['id_type_adresse'] == 1) {
    return array('status_code' => 400, 'message' => 'Le type d\'adresse n\'est pas valide pour un client.');
}
if (!Checkdroits::checkPermObj($bddConnection, $sessionUser['idLogin'], $_POST['id_compte_client'], 'compte', 'addCompteToCommande', $sessionUser['isApi'])) {
    return array('status_code' => 403, 'message' => 'Vous n\'avez pas la permission d\'effectuer cette action.');
}
$compte = Comptes::getCompteById($bddConnection, $_POST['id_compte_client']);
if (!$compte['id_type_compte'] == 1) {
    return array('status_code' => 400, 'message' => 'Le type de compte client doit être un compte joueur.');
}
if (strlen($_POST['nom']) > $_Serveur_['MaxLengthChamps']['Nom']) {
    return array('status_code' => 413, 'message' => 'Le nom de la commande est trop long.');
}
if (strlen($_POST['description']) > $_Serveur_['MaxLengthChamps']['Description']) {
    return array('status_code' => 413, 'message' => 'La description de la commande est trop long.');
}
$passwordRetrait = Checkdroits::generatePassword(16);
$newCommande = new Commandes($bddConnection);
$suivi = "";
if ($methodecommande == 1) {
    $compteDebiteur = new Comptes($bddConnection, $_POST['id_compte_client']);
    if ($compteDebiteur->getSolde() < $_POST['montant']) {
        return array('status_code' => 403, 'message' => 'Le compte debiteur n\'a pas assez d\'argent.');
    }
    $compteDebiteur->setCompteSolde($compteDebiteur->getSolde() - $_POST['montant']);
    $compteCrediteur = new Comptes($bddConnection, $offre['id_compte']);
    $compteCrediteur->setCompteSolde($compteCrediteur->getSolde() + $_POST['montant']);
    $suivi = $sessionUser['pseudoLogin'].' a cree la commande via keypay.';
    $newCommande->addCommande($_POST['nom'],$quant,$prixu,$frait,$_POST['description'],$passwordRetrait,$_POST['id_adresse_vendeur'],$_POST['id_adresse_client'],$_POST['id_offre'],$_POST['id_compte_vendeur'],$_POST['id_compte_client'],15);
    $newCommande->setCommandeSuivi($suivi,$_Serveur_['General']['CaseLigneSuite']);
    $newId = Transactions::addTransaction($bddConnection, $_POST['id_compte_client'], $offre['id_compte'],$idAdmin, $_POST['montant'], $_POST['nom'], $_POST['description'], 3, $newCommande->getIdCommande());
    return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newCommande->getIdCommande(), 'password' => $passwordRetrait, 'transactionId' => $newId));
} elseif ($methodecommande == 2) {
    $suivi = $sessionUser['pseudoLogin'].' a cree la commande manuellement.';
    $newCommande->addCommande($_POST['nom'],$quant,$prixu,$frait,$_POST['description'],$passwordRetrait,$_POST['id_adresse_vendeur'],$_POST['id_adresse_client'],$_POST['id_offre'],$_POST['id_compte_vendeur'],$_POST['id_compte_client'],1);
    $newCommande->setCommandeSuivi($suivi,$_Serveur_['General']['CaseLigneSuite']);
    return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newCommande->getIdCommande(), 'password' => $passwordRetrait));
}