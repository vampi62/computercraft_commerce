<?php
require_once('class/joueurs.class.php');
require_once('class/comptes.class.php');
require_once('class/checkdroits.class.php');

if(Checkdroits::CheckArgs($_GET,array('pseudo','mdp','idcompte','newnom'))) {
    $_GET['pseudo']= htmlspecialchars($_GET['pseudo']);
    $_GET['mdp'] = htmlspecialchars($_GET['mdp']);
    $_GET['idcompte'] = htmlspecialchars($_GET['idcompte']);
    $_GET['newnom'] = htmlspecialchars($_GET['newnom']);
    $donneesJoueurPseudo = Joueurs::getJoueurbyPseudo($bddConnection, $_GET['pseudo']);
    if(!empty($donneesJoueurPseudo['pseudo'])) {
        if(password_verify($_GET['mdp'], $donneesJoueurPseudo['mdp'])) {
            if(!empty($_GET['idcompte'])){
                $compte = Comptes::getCompte($bddConnection, $_GET['idcompte']);
                if (!empty($compte['idcompte'])) {
                    if ($compte["id_joueur"] == $donneesJoueurPseudo["id_joueur"]) { // proprio du compte
                        Comptes::setCompteNom($bddConnection, $_GET['idcompte'], $_GET['newnom']);
                        $printmessage = array('status_code' => 200, 'message' => 'Le compte a bien ete modifie.');
                    } elseif (Checkdroits::CheckPermObj($bddConnection, $_GET['idcompte'], $donneesJoueurPseudo['pseudo'], 'compte', 'setnomcompte')){ // membre d'un groupe avec les droits
                        Comptes::setCompteNom($bddConnection, $_GET['idcompte'], $_GET['newnom']);
                        $printmessage = array('status_code' => 200, 'message' => 'Le compte a bien ete modifie.');
                    } else {
                        // modif - le compte ne vous appartient pas
                        $printmessage = array('status_code' => 403, 'message' => 'Le compte ne vous appartient pas.');
                    }
                } else {
                    // modif - le compte n'existe pas
                    $printmessage = array('status_code' => 403, 'message' => 'Le compte n\'existe pas.');
                }
            } else {
                // modif - le nom est vide
                $printmessage = array('status_code' => 403, 'message' => 'Le compte id est vide.');
            }
        } else {
            // modif - le mot de passe n'est pas correct
            $printmessage = array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
        }
    } else {
        // modif - le compte n'existe pas
        $printmessage = array('status_code' => 403, 'message' => 'Le compte n\'existe pas.');
    }
} else {
    // modif - il manque des parametres
    $printmessage = array('status_code' => 400, 'message' => 'Il manque des parametres.');
}