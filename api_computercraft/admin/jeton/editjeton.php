<?php
require_once('class/joueurs.class.php');
require_once('class/jetons.class.php');
require_once('class/checkdroits.class.php');

if(checkdroits::CheckArgs($_GET,array('pseudo','useraction','mdp','jeton1','jeton10','jeton100','jeton1k','jeton10k'))) {
    $_GET['pseudo']= htmlspecialchars($_GET['pseudo']);
    $_GET['useraction'] = htmlspecialchars($_GET['useraction']);
    $_GET['mdp'] = htmlspecialchars($_GET['mdp']);
    $_GET['jeton1'] = $_GET['jeton1'];
    $_GET['jeton10'] = $_GET['jeton10'];
    $_GET['jeton100'] = $_GET['jeton100'];
    $_GET['jeton1k'] = $_GET['jeton1k'];
    $_GET['jeton10k'] = $_GET['jeton10k'];
    $donneesJoueurUserAction = Joueur::getJoueurbyPseudo($bddConnection, $_GET['useraction']);
    if ($_GET['pseudo'] != $_GET['useraction']) {
        $donneesJoueurPseudo = Joueur::getJoueurbyPseudo($bddConnection, $_GET['pseudo']);
    }
    if(!empty($donneesJoueurUserAction['pseudo']) && !empty($donneesJoueurPseudo['pseudo'])) {
        if(checkdroits::CheckPassword($donneesJoueurUserAction['mdp'], $_GET['mdp'])) {
            if(checkdroits::CheckRole($_GET['useraction'], array('admin'))) {
                if(!empty(Jeton::getjetonByJoueur($bddConnection, $donneesJoueurPseudo['id_joueur']))) {
                    Jeton::setSyncJeton($bddConnection, $donneesJoueurPseudo['id_joueur'], array("1" => $_GET['jeton1'], "10" => $_GET['jeton10'], "100" => $_GET['jeton100'], "1k" => $_GET['jeton1k'], "10k" => $_GET['jeton10k']));
                    $printmessage = array('status_code' => 200, 'message' => 'Le jeton a ete synchronise.');
                } else {
                    $printmessage = array('status_code' => 403, 'message' => 'Le jeton n\'existe pas.');
                }
            } else {
                // modif - le compte n'est pas admin
                $printmessage = array('status_code' => 403, 'message' => 'Le compte n\'est pas admin.');
            }
        } else {
            // modif - le compte n'est pas admin
            $printmessage = array('status_code' => 403, 'message' => 'Le compte n\'est pas admin.');
        }
    } else {
        // modif - le compte n'existe pas
        $printmessage = array('status_code' => 403, 'message' => 'Le compte n\'existe pas.');
    }
} else {
    // modif - il manque des parametres
    $printmessage = array('status_code' => 400, 'message' => 'Il manque des parametres.');
}