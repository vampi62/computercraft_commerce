<?php
require_once('class/joueurs.class.php');
require_once('class/comptes.class.php');
require_once('class/checkdroits.class.php');

if(checkdroits::CheckArgs($_GET,array('pseudo','mdp','nom','idtype'))) {
    $_GET['pseudo']= htmlspecialchars($_GET['pseudo']);
    $_GET['mdp'] = htmlspecialchars($_GET['mdp']);
    $_GET['nom'] = htmlspecialchars($_GET['nom']);
    $_GET['idtype'] = htmlspecialchars($_GET['idtype']);
    $donneesJoueurPseudo = Joueur::getJoueurbyPseudo($bddConnection, $_GET['pseudo']);
    if(!empty($donneesJoueurPseudo['pseudo'])) {
        if(password_verify($_GET['mdp'], $donneesJoueurPseudo['mdp'])) {
            if(!empty($_GET['nom'])){
                if (checkdroits::CheckId($bddConnection,'liste_types_compte',$_GET['idtype'])) {
                    Comptes::setCompte($bddConnection, $donneesJoueurPseudo['id_joueur'], $_GET['nom'], $_GET['type']);
                    $printmessage = array('status_code' => 200, 'message' => 'Le compte a bien ete ajoute.');
                } else {
                    // modif - le type de compte n'existe pas
                    $printmessage = array('status_code' => 403, 'message' => 'Le type de compte n\'existe pas.');
                }
            } else {
                // modif - le nom est vide
                $printmessage = array('status_code' => 403, 'message' => 'Le nom est vide.');
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