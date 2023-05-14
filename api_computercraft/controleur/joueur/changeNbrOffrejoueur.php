<?php
require_once('class/joueurs.class.php');
require_once('include/phpmailer/MailSender.php');
require_once('class/checkdroits.class.php');

if(checkdroits::CheckArgs($_GET,array('pseudo','mdp','nbr_offre'))) {
    $_GET['pseudo']= htmlspecialchars($_GET['pseudo']);
    $_GET['mdp'] = htmlspecialchars($_GET['mdp']);
    $_GET['nbr_offre'] = htmlspecialchars($_GET['nbr_offre']);
    $donneesJoueurPseudo = Joueur::getJoueurbyPseudo($bddConnection, $_GET['pseudo']);
    if(!empty($donneesJoueurPseudo['pseudo'])) {
        if(password_verify($_GET['mdp'], $donneesJoueurPseudo['mdp'])) {
            //-modif- verification compte a debiter
            if (false) {
                Joueur::setNbrOffre($bddConnection, $_GET['pseudo'], $_GET['nbr_offre']);
                $printmessage = array('status_code' => 200, 'message' => 'Le nombre d\'offre a bien ete modifie.');
            } else {
                // modif - le compte executant n'est pas admin
                $printmessage = array('status_code' => 403, 'message' => 'Vous ne pouvez pas modifier le nombre d\'offre de ce compte.');
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