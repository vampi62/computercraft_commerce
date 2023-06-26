<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

$joueurs = Joueurs::getJoueurs($bddConnection);

foreach ($joueurs as $id => $joueur) {
    unset($joueurs[$id]['email_joueur']);
}
return array('status_code' => 200, 'messsage' => '' ,'data' => $joueurs);