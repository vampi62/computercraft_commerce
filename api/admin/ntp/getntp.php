<?php
$printmessage = array();
$printmessage['seconde'] = date("s");
$printmessage['minute'] = date("i");
$printmessage['heure'] = date("H");
$printmessage['jour'] = date("d");
$printmessage['mois'] = date("m");
$printmessage['annee'] = date("Y");
return array('status_code' => 200, 'message' => '', 'data' => $printmessage);