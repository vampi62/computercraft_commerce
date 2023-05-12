<?php
require_once('class/joueurs.class.php');
require_once('include/phpmailer/MailSender.php');
require_once('class/checkdroits.class.php');

if(checkdroits::CheckArgs($_GET,array('pseudo','mdp'))) {
    $_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
    $_GET['mdp'] = htmlspecialchars($_GET['mdp']);
    $donneesJoueurPseudo = Joueur::getJoueurbyPseudo($bddConnection, $_GET['pseudo']);
    if(!empty($donneesJoueurPseudo['pseudo'])) {
        if(password_verify($_GET['mdp'], $donneesJoueurPseudo['mdp'])) {
            if(checkdroits::CheckRole($_GET['pseudo'], array('admin'))) {
                // modif - le compte cible est admin
                $printmessage = array('status_code' => 403, 'message' => 'Vous ne pouvez pas supprimer votre compte admin.');
            }
            else {
                Joueur::delJoueur($bddConnection, $_GET['pseudo']);
                $printmessage = array('status_code' => 200, 'message' => 'Le compte a bien été supprimé.');
            }
        } else {
            // modif - le mot de passe n'est pas identique
            $printmessage = array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
        }
    } else {
        // modif - le compte n'existe pas
        $printmessage = array('status_code' => 403, 'message' => 'Le compte n\'existe pas.');
    }
} else {
    // modif - il manque des parametres
    $printmessage = array('status_code' => 400, 'message' => 'Il manque des paramètres.');
}