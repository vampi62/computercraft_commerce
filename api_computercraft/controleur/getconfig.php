<?php
require_once('class/droits.class.php');
$printmessage = array();
$printmessage['General'] = $_Serveur_['General'];
$printmessage['Droits'] = Droits::getDroits($bddConnection);


// type_adresses
// type_comptes
// type_offres
// type_roles
// type_status_commandes
// type_status_litiges
// type_status_transactions
// type_transactions
// chemin_status_commandes
?>