<?php
require_once('class/joueurs.class.php');
require_once('class/jetons.class.php');
require_once('class/checkdroits.class.php');

if(checkdroits::CheckArgs($_GET,array('useraction','mdp'))) {
    $_GET['useraction'] = htmlspecialchars($_GET['useraction']);
    $_GET['mdp'] = htmlspecialchars($_GET['mdp']);
    $donneesJoueurUserAction = Joueur::getJoueurbyPseudo($bddConnection, $_GET['useraction']);
    if(!empty($donneesJoueurUserAction['pseudo'])) {
        if(checkdroits::CheckPassword($donneesJoueurUserAction['mdp'], $_GET['mdp'])) {
            if(checkdroits::CheckRole($_GET['useraction'], array('admin'))) {
                $jeton = Jeton::getJetons($bddConnection);
                $printmessage = array('status_code' => 200, 'message' => 'Le jeton a bien ete recupere.', 'data' => $jeton);
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