<?php
require_once('class/keyapis.class.php');
require_once('class/jetons.class.php');
require_once('class/checkdroits.class.php');

if(checkdroits::CheckArgs($_GET,array('idkeyapi','mdp','jeton1','jeton10','jeton100','jeton1k','jeton10k'))) {
    $_GET['idkeyapi'] = $_GET['idkeyapi'];
    $_GET['mdp'] = $_GET['mdp'];
    $_GET['jeton1'] = $_GET['jeton1'];
    $_GET['jeton10'] = $_GET['jeton10'];
    $_GET['jeton100'] = $_GET['jeton100'];
    $_GET['jeton1k'] = $_GET['jeton1k'];
    $_GET['jeton10k'] = $_GET['jeton10k'];
    $donneesKeyapi = Keyapis::getKeyapi($bddConnection, $_GET['idkeyapi']);
    if(!empty($donneesKeyapi['nom'])) {
        if(checkdroits::CheckPassword($donneesKeyapi['mdp'], $_GET['mdp'],true)) {
            if(!empty(Jeton::getJetonByJoueur($bddConnection, $donneesKeyapi['id_joueur']))) {
                Jeton::setSyncJeton($bddConnection, $donneesKeyapi['id_joueur'], array("1" => $_GET['jeton1'], "10" => $_GET['jeton10'], "100" => $_GET['jeton100'], "1k" => $_GET['jeton1k'], "10k" => $_GET['jeton10k']));
                $printmessage = array('status_code' => 200, 'message' => 'Le jeton a ete synchronise.');
            } else {
                $printmessage = array('status_code' => 403, 'message' => 'Le jeton n\'existe pas.');
            }
        } else {
            // modif - le mot de passe est incorrect
            $printmessage = array('status_code' => 402, 'message' => 'Le mot de passe est incorrect.');
        }
    } else {
        // modif - le compte n'existe pas
        $printmessage = array('status_code' => 403, 'message' => 'L\'apikey n\'existe pas.');
    }
} else {
    // modif - il manque des parametres
    $printmessage = array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
