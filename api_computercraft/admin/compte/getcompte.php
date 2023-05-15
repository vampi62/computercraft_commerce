<?php
require_once('class/joueurs.class.php');
require_once('class/comptes.class.php');
require_once('class/checkdroits.class.php');

if(checkdroits::CheckArgs($_GET,array('pseudo','useraction','mdp'))) {
    $_GET['pseudo']= htmlspecialchars($_GET['pseudo']);
    $_GET['mdp'] = htmlspecialchars($_GET['mdp']);
    $_GET['idcompte'] = htmlspecialchars($_GET['idcompte']);
    $donneesJoueurUserAction = Joueur::getJoueurbyPseudo($bddConnection, $_GET['useraction']);
    if ($_GET['pseudo'] != $_GET['useraction']) {
        $donneesJoueurPseudo = Joueur::getJoueurbyPseudo($bddConnection, $_GET['pseudo']);
    } else {
        $donneesJoueurPseudo = $donneesJoueurUserAction;
    }
    if(!empty($donneesJoueurUserAction['pseudo']) && !empty($donneesJoueurPseudo['pseudo'])) {
        if(password_verify($_GET['mdp'], $donneesJoueurUserAction['mdp'])) {
            if(checkdroits::CheckRole($_GET['useraction'], array('admin'))) {
                $comptes = Comptes::getComptesWithUser($bddConnection, $donneesJoueurPseudo['id_joueur']);
                $printmessage = array('status_code' => 200, 'message' => 'Les comptes ont bien ete recuperees.', 'data' => $comptes);
            } else {
                // modif - le compte n'a pas les droits
                $printmessage = array('status_code' => 403, 'message' => 'Le compte n\'a pas les droits.');
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
