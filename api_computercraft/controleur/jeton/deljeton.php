<?php
require_once('class/joueurs.class.php');
require_once('class/jetons.class.php');
require_once('class/checkdroits.class.php');

if(Checkdroits::CheckArgs($_GET,array('pseudo','mdp'))) {
    $_GET['pseudo'] = $_GET['pseudo'];
    $_GET['mdp'] = $_GET['mdp'];
    $donneesJoueurPseudo = Joueurs::getJoueurbyPseudo($bddConnection, $_GET['pseudo']);
    if(!empty($donneesJoueurPseudo['pseudo'])) {
        if(Checkdroits::CheckPassword($donneesJoueurPseudo['mdp'], $_GET['mdp'])) {
            if(Checkdroits::CheckRole($_GET['useradmin'], array('terminal'))) {
                if(!empty(Jeton::getJetonByJoueur($bddConnection, $donneesJoueurPseudo['id_joueur']))) {
                    Jeton::delJeton($bddConnection, $donneesJoueurPseudo['id_joueur']);
                    $printmessage = array('status_code' => 200, 'message' => 'Le jeton a ete supprime.');
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