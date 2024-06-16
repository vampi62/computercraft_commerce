<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_GET,array('offset' => true, 'limit' => true))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
Checkdroits::checkLimitOffset($_Serveur_, $_GET['limit'], $_GET['offset']);
$joueurs = Joueurs::getJoueurs($bddConnection, $_GET['limit'], $_GET['offset']);
foreach ($joueurs as $id => $joueur) {
    unset($joueurs[$id]['email_joueur']);
}
return array('status_code' => 200, 'messsage' => '' ,'data' => $joueurs);