<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useruser' => false,'mdpuser' => false, 'mdp' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$joueur = Joueurs::getJoueurByPseudo($bddConnection, $_GET['useruser']);
if (empty($joueur)) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (!Checkdroits::CheckMdp($bddConnection, $_GET['useruser'], $_GET['mdpuser'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
if (!Checkdroits::CheckPasswordSecu($_GET['mdp'])) {
    return array('status_code' => 400, 'message' => 'Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre.');
}
Joueurs::setJoueurMdp($bddConnection, $joueur['id_joueur'], $_GET['mdp']);
return array('status_code' => 200, 'message' => '');