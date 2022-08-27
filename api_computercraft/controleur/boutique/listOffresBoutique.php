<?php
require_once('modele/boutique/boutique.class.php');
require_once('modele/converttable.class.php');
$player['id']=0;
$boutique = new Boutique($player, $bddConnection);
$listeboutique = $boutique->getOffres();
// modif - print $listeboutique
$printmessage = $listeboutique;
?>