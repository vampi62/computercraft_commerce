<?php
require_once('class/joueurs.class.php');
require_once('class/jetons.class.php');
require_once('class/checkdroits.class.php');

if(checkdroits::CheckArgs($_GET,array('pseudo','useraction','mdp'))) {
    $_GET['pseudo']= htmlspecialchars($_GET['pseudo']);
    $_GET['useraction'] = htmlspecialchars($_GET['useraction']);
    $_GET['mdp'] = htmlspecialchars($_GET['mdp']);
    $donneesJoueurUserAction = Joueur::getJoueurbyPseudo($bddConnection, $_GET['useraction']);
    if ($_GET['pseudo'] != $_GET['useraction']) {
        $donneesJoueurPseudo = Joueur::getJoueurbyPseudo($bddConnection, $_GET['pseudo']);
    }
    if(!empty($donneesJoueurUserAction['pseudo']) && !empty($donneesJoueurPseudo['pseudo'])) {
        if(checkdroits::CheckPassword($donneesJoueurUserAction['mdp'], $_GET['mdp'])) {
            if(checkdroits::CheckRole($_GET['useraction'], array('admin'))) {
                if(!empty(Jeton::getjetonByJoueur($bddConnection, $donneesJoueurPseudo['id_joueur']))) {
                    $jeton = Jeton::delJeton($bddConnection, $donneesJoueurPseudo['id_joueur']);
                    $printmessage = array('status_code' => 200, 'message' => 'Le jeton a bien ete supprime.');
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