<?php
require_once('class/joueurs.class.php');
require_once('class/jetons.class.php');
require_once('class/checkdroits.class.php');

if(checkdroits::CheckArgs($_GET,array('pseudo','mdp'))) {
    $_GET['pseudo'] = $_GET['pseudo'];
    $_GET['mdp'] = $_GET['mdp'];
    $donneesJoueurPseudo = Joueur::getJoueurbyPseudo($bddConnection, $_GET['pseudo']);
    if(!empty($donneesJoueurPseudo['pseudo'])) {
        if(checkdroits::CheckPassword($donneesJoueurPseudo['mdp'], $_GET['mdp'])) {
            if(checkdroits::CheckRole($_GET['useraction'], array('terminal'))) {
                if(!empty(Jeton::getJetonByJoueur($bddConnection, $donneesJoueurPseudo['id_joueur']))) {
                    Jeton::setInitJeton($bddConnection, $donneesJoueurPseudo['id_joueur'], array("1" => 0, "10" => 0, "100" => 0, "1k" => 0, "10k" => 0));
                    $printmessage = array('status_code' => 200, 'message' => 'Le jeton a ete ajoute.');
                } else {
                    $printmessage = array('status_code' => 403, 'message' => 'Le jeton existe deja.');
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