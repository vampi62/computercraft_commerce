<?php
require_once('class/joueurs.class.php');
require_once('class/keyapis.class.php');
require_once('class/comptes.class.php');
require_once('class/checkdroits.class.php');

if(Checkdroits::CheckArgs($_GET,array('pseudo','mdp'))) {
    $_GET['pseudo']= htmlspecialchars($_GET['pseudo']);
    $_GET['mdp'] = htmlspecialchars($_GET['mdp']);
    $donneesJoueurPseudo = Joueurs::getJoueurbyPseudo($bddConnection, $_GET['pseudo']);
    if(!empty($donneesJoueurPseudo['pseudo'])) {
        if(password_verify($_GET['mdp'], $donneesJoueurPseudo['mdp'])) {
            $comptes = Comptes::getComptesWithUser($bddConnection, $donneesJoueurPseudo['id_joueur']);
            $printmessage = array('status_code' => 200, 'message' => 'Les comptes ont bien ete recupere.', 'data' => $comptes);
        } else {
            // modif - le mot de passe n'est pas correct
            $printmessage = array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
        }
    } else {
        // modif - le compte n'existe pas
        $printmessage = array('status_code' => 403, 'message' => 'Le compte n\'existe pas.');
    }
} elseif(Checkdroits::CheckArgs($_GET,array('idkeyapi','mdp'))) {
    $_GET['idkeyapi']= htmlspecialchars($_GET['idkeyapi']);
    $_GET['mdp'] = htmlspecialchars($_GET['mdp']);
    $donneesKeyapi = Keyapis::getKeyapi($bddConnection, $_GET['idkeyapi']);
    if(!empty($donneesKeyapi['nom'])) {
        if(Checkdroits::CheckPassword($donneesKeyapi['mdp'], $_GET['mdp'],true)) {
            $comptes = Comptes::getComptesWithKeyApi($bddConnection, $_GET['idkeyapi']);
            $printmessage = array('status_code' => 200, 'message' => 'Les comptes ont bien ete recupere.', 'data' => $comptes);
        } else {
            // modif - le mot de passe n'est pas correct
            $printmessage = array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
        }
    } else {
        // modif - la keyapi n'existe pas
        $printmessage = array('status_code' => 403, 'message' => 'La keyapi n\'existe pas.');
    }
}
else {
    // modif - il manque des parametres
    $printmessage = array('status_code' => 400, 'message' => 'Il manque des parametres.');
}