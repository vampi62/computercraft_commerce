<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

$joueursall = Joueurs::getJoueurs($bddConnection);
foreach ($joueursall as $joueur) {
    unset($joueur['email_joueur']);
}
return array('status_code' => 200, 'messsage' => '' ,'data' => $joueursall);