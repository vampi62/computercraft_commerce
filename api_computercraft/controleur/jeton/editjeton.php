<?php
require_once('class/joueurs.class.php');
require_once('class/jetons.class.php');
require_once('class/checkdroits.class.php');

if(checkdroits::CheckArgs($_GET,array('apikey','mdp','jeton1','jeton10','jeton100','jeton1k','jeton10k'))) {
    $_GET['apikey'] = $_GET['apikey'];
    $_GET['mdp'] = $_GET['mdp'];
    $_GET['jeton1'] = $_GET['jeton1'];
    $_GET['jeton10'] = $_GET['jeton10'];
    $_GET['jeton100'] = $_GET['jeton100'];
    $_GET['jeton1k'] = $_GET['jeton1k'];
    $_GET['jeton10k'] = $_GET['jeton10k'];
    $donneesJoueurPseudo = Joueur::getJoueurbyPseudo($bddConnection, $_GET['apikey']);
    if(!empty($donneesJoueurPseudo['nom'])) {
        if(checkdroits::CheckPassword($donneesJoueurPseudo['mdp'], $_GET['mdp'])) {
            if(checkdroits::CheckRole($_GET['useraction'], 'terminal')) {
                if(!empty(Jeton::getJeton($bddConnection, $donneesJoueurPseudo['id_joueur']))) {
                    Jeton::setSyncJeton($bddConnection, $donneesJoueurPseudo['id_joueur'], array("1" => $jeton1, "10" => $jeton10, "100" => $jeton100, "1k" => $jeton1k, "10k" => $jeton10k));
                    $printmessage = array('status_code' => 200, 'message' => 'Le jeton a ete synchronise.');
                } else {
                    $printmessage = array('status_code' => 403, 'message' => 'Le jeton n\'existe pas.');
                }
            } else {
                // modif - le compte n'est pas admin
                $printmessage = array('status_code' => 403, 'message' => 'Le compte n\'est pas admin.');
            }
        } else {
            // modif - le mot de passe est incorrect
            $printmessage = array('status_code' => 402, 'message' => 'Le mot de passe est incorrect.');
        }
    } else {
        // modif - le compte n'existe pas
        $printmessage = array('status_code' => 403, 'message' => 'Le compte n\'existe pas.');
    }
} else {
    // modif - il manque des parametres
    $printmessage = array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
