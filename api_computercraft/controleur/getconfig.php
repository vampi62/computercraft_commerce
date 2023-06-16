<?php
require_once('class/droits.class.php');
$printmessage = array();
$printmessage['General'] = $_Serveur_['General'];
$printmessage['MaxLengthChamps'] = $_Serveur_['MaxLengthChamps'];
$printmessage['Droits'] = Droits::getDroits($bddConnection);
$printmessage['TypeAdresses'] = Droits::getTypeAdresses($bddConnection);
$printmessage['TypeComptes'] = Droits::getTypeComptes($bddConnection);
$printmessage['TypeOffres'] = Droits::getTypeOffres($bddConnection);
$printmessage['TypeRoles'] = Droits::getTypeRoles($bddConnection);
$printmessage['TypeStatusCommandes'] = Droits::getTypeStatusCommandes($bddConnection);
$printmessage['TypeStatusLitiges'] = Droits::getTypeStatusLitiges($bddConnection);
$printmessage['TypeStatusTransactions'] = Droits::getTypeStatusTransactions($bddConnection);
$printmessage['TypeTransactions'] = Droits::getTypeTransactions($bddConnection);
$printmessage['CheminStatusCommandes'] = Droits::getCheminStatusCommandes($bddConnection);
return array('status_code' => 200, 'message' => '', 'data' => $printmessage);
?>