<?php
require_once('class/joueurs.class.php');
require_once('include/phpmailer/MailSender.php');
require_once('class/checkdroits.class.php');

if(checkdroits::CheckArgs($_GET,array('pseudo','mdp','newmdp','confirmnewmdp'))) {
    $_GET['pseudo']= htmlspecialchars($_GET['pseudo']);
    $_GET['mdp'] = htmlspecialchars($_GET['mdp']);
    $_GET['newmdp'] = htmlspecialchars($_GET['newmdp']);
    $_GET['confirmnewmdp'] = htmlspecialchars($_GET['confirmnewmdp']);
    $donneesJoueurPseudo = Joueur::getJoueurbyPseudo($bddConnection, $_GET['pseudo']);
    if(!empty($donneesJoueurPseudo['pseudo'])) {
        if(password_verify($_GET['mdp'], $donneesJoueurPseudo['mdp'])) {
            if ($_GET['newmdp'] == $_GET['confirmnewmdp']) {
                Joueur::setMdp($bddConnection, $_GET['pseudo'], $_GET['newmdp']);
                $printmessage = array('status_code' => 200, 'message' => 'Le mot de passe a bien ete modifie.');    
            } else {
                // modif - le mot de passe n'est pas identique
                $printmessage = array('status_code' => 403, 'message' => 'Le mot de passe n\'est pas identique.');
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