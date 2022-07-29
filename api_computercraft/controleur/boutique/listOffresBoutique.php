<?php
require_once('modele/boutique/boutique.class.php');
require_once('modele/converttable.class.php');

$boutique = new Boutique(0, $bddConnection);
$listeboutique = $boutique->getOffres();
// modif - print $listeboutique
$printmessage = $listeboutique;
?>