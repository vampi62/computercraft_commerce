<?php
require_once('class/joueurs.class.php');
require_once('include/phpmailer/MailSender.php');
require_once('class/checkdroits.class.php');

if(checkdroits::CheckArgs($_GET,array('pseudo','useraction','mdp','nbr_offre'))) {
    $_GET['pseudo']= htmlspecialchars($_GET['pseudo']);
    $_GET['useraction'] = htmlspecialchars($_GET['useraction']);
    $_GET['mdp'] = htmlspecialchars($_GET['mdp']);
    $_GET['nbr_offre'] = htmlspecialchars($_GET['nbr_offre']);
    $donneesJoueurUserAction = Joueur::getJoueurbyPseudo($bddConnection, $_GET['pseudo']);
    if ($_GET['pseudo'] != $_GET['useraction']) {
        $donneesJoueurPseudo = Joueur::getJoueurbyPseudo($bddConnection, $_GET['useraction']);
    } else {
        $donneesJoueurPseudo = $donneesJoueurUserAction;
    }
    if(!empty($donneesJoueurUserAction['pseudo']) && !empty($donneesJoueurPseudo['pseudo'])) {
        if(password_verify($_GET['mdp'], $donneesJoueurUserAction['mdp'])) {
            if (checkdroits::CheckRole($_GET['useraction'], 'admin')) {
                Joueur::setNbrOffre($bddConnection, $_GET['pseudo'], $_GET['nbr_offre']);
                $printmessage = array('status_code' => 200, 'message' => 'Le role a bien ete modifie.');
            } else {
                // modif - le compte n'est pas admin
                $printmessage = array('status_code' => 403, 'message' => 'Le compte n\'est pas admin.');
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
    $printmessage = array('status_code' => 400, 'message' => 'Il manque des parametres.');
}