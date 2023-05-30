<?php
require_once('class/joueurs.class.php');
require_once('class/keyapis.class.php');
require_once('class/jetons.class.php');
require_once('class/checkdroits.class.php');

if(Checkdroits::CheckArgs($_GET,array('idkeyapi','mdp'))) {
    $_GET['idkeyapi'] = $_GET['idkeyapi'];
    $_GET['mdp'] = $_GET['mdp'];
    $donneesKeyapi = Keyapis::getKeyapi($bddConnection, $_GET['idkeyapi']);
    if(!empty($donneesKeyapi['nom'])) {
        if(Checkdroits::CheckPassword($donneesKeyapi['mdp'], $_GET['mdp'],true)) {
            $jetons = Jeton::getJetons($bddConnection);
            if(!empty($jetons)) {
                $printmessage = array('status_code' => 200, 'message' => 'Les jetons ont ete recupere.', 'data' => $jetons);
            } else {
                $printmessage = array('status_code' => 403, 'message' => 'Les jetons n\'existent pas.');
            }
        } else {
            // modif - le mot de passe est incorrect
            $printmessage = array('status_code' => 402, 'message' => 'Le mot de passe est incorrect.');
        }
    } else {
        // modif - le compte n'existe pas
        $printmessage = array('status_code' => 403, 'message' => 'L\'keyapi n\'existe pas.');
    }
}
elseif(Checkdroits::CheckArgs($_GET,array('pseudo','mdp'))) {
    $_GET['pseudo'] = $_GET['pseudo'];
    $_GET['mdp'] = $_GET['mdp'];
    $donneesJoueur = Joueurs::getJoueur($bddConnection, $_GET['pseudo']);
    if(!empty($donneesJoueur['pseudo'])) {
        if(Checkdroits::CheckPassword($donneesJoueur['mdp'], $_GET['mdp'])) {
            if(Checkdroits::CheckRole($donneesJoueur['role'], array('terminal'))) {
                $jetons = Jeton::getJetons($bddConnection);
                if(!empty($jetons)) {
                    $printmessage = array('status_code' => 200, 'message' => 'Les jetons ont ete recupere.', 'data' => $jetons);
                } else {
                    $printmessage = array('status_code' => 403, 'message' => 'Les jetons n\'existent pas.');
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
}
else {
    // modif - il manque des parametres
    $printmessage = array('status_code' => 400, 'message' => 'Il manque des parametres.');
}