<?php
require_once('class/joueurs.class.php');
require_once('include/phpmailer/MailSender.php');
require_once('class/checkdroits.class.php');

if(checkdroits::CheckArgs($_GET,array('pseudo','useraction','mdp','newemail'))) {
    $_GET['pseudo']= htmlspecialchars($_GET['pseudo']);
    $_GET['useraction'] = htmlspecialchars($_GET['useraction']);
    $_GET['mdp'] = htmlspecialchars($_GET['mdp']);
    $_GET['newemail'] = htmlspecialchars($_GET['newemail']);
    $donneesJoueurUserAction = Joueur::getJoueurbyPseudo($bddConnection, $_GET['pseudo']);
    if ($_GET['pseudo'] != $_GET['useraction']) {
        $donneesJoueurPseudo = Joueur::getJoueurbyPseudo($bddConnection, $_GET['useraction']);
    } else {
        $donneesJoueurPseudo = $donneesJoueurUserAction;
    }
    if(!empty($donneesJoueurUserAction['pseudo']) && !empty($donneesJoueurPseudo['pseudo'])) {
        if(checkdroits::CheckPassword($donneesJoueurUserAction['mdp'], $_GET['mdp'])) {
            if(checkdroits::CheckRole($_GET['useraction'], 'admin')) {
                Joueur::setEmail($bddConnection, $_GET['pseudo'], $_GET['newemail']);
                $printmessage = array('status_code' => 200, 'message' => 'L\'email a bien ete modifie.');
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