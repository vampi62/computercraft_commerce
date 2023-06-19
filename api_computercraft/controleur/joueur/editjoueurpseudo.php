<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::CheckArgs($_GET,array('useruser' => false,'mdpuser' => false, 'pseudo' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$joueur = Joueurs::getJoueurByPseudo($bddConnection, $_GET['useruser']);
if (empty($joueur)) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (!Checkdroits::CheckMdp($bddConnection, $_GET['useruser'], $_GET['mdpuser'])) {
    return array('status_code' => 403, 'message' => 'Le mot de passe est incorrect.');
}
if (strlen($_GET['pseudo']) > $_Serveur_['MaxLengthChamps']['pseudo']) {
    return array('status_code' => 413, 'message' => 'Le pseudo est trop long.');
}
if (!empty(Joueurs::getJoueurByPseudo($bddConnection, $_GET['pseudo']))) {
    return array('status_code' => 403, 'message' => 'Le pseudo est deja pris.');
}
Joueurs::setJoueurPseudo($bddConnection, $joueur['id_joueur'], $_GET['pseudo']);
return array('status_code' => 200, 'message' => '');