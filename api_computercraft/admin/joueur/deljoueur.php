<?php
require_once('class/joueurs.class.php');
require_once('include/phpmailer/MailSender.php');
require_once('class/checkdroits.class.php');

if(checkdroits::CheckArgs($_GET,array('pseudo','useraction','mdp'))) {
    $_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
    $_GET['useraction'] = htmlspecialchars($_GET['useraction']);
    $_GET['mdp'] = htmlspecialchars($_GET['mdp']);
    $donneesJoueurPseudo = Joueur::getJoueurbyPseudo($bddConnection, $_GET['pseudo']);
    if ($_GET['pseudo'] != $_GET['useraction']) {
        $donneesJoueurUserAction = Joueur::getJoueurbyPseudo($bddConnection, $_GET['useraction']);
    } else {
        $donneesJoueurUserAction = $donneesJoueurPseudo;
    }
    if(!empty($donneesJoueurUserAction['pseudo']) && !empty($donneesJoueurPseudo['pseudo'])) {
        if(password_verify($_GET['mdp'], $donneesJoueurUserAction['mdp'])) {
            $isadmin = checkdroits::CheckRole($_GET['useraction'], array('admin'));
            if($isadmin && $donneesJoueurUserAction['pseudo'] != $donneesJoueurPseudo['pseudo']) {
                Joueur::delJoueur($bddConnection, $_GET['pseudo']);
                $printmessage = array('status_code' => 200, 'message' => 'Le compte a bien été supprimé.');
            }
            elseif (!$isadmin && $donneesJoueurUserAction['pseudo'] == $donneesJoueurPseudo['pseudo']) {
                Joueur::delJoueur($bddConnection, $_GET['pseudo']);
                $printmessage = array('status_code' => 200, 'message' => 'Le compte a bien été supprimé.');
            }
            elseif($isadmin && $donneesJoueurUserAction['pseudo'] == $donneesJoueurPseudo['pseudo']) {
                // modif - le compte cible est admin
                $printmessage = array('status_code' => 403, 'message' => 'Vous ne pouvez pas supprimer votre compte admin.');
            }
            elseif (!$isadmin && $donneesJoueurUserAction['pseudo'] != $donneesJoueurPseudo['pseudo']) {
                // modif - le compte executant n'est pas admin
                $printmessage = array('status_code' => 403, 'message' => 'Vous ne pouvez pas supprimer ce compte.');
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