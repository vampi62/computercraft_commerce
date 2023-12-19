<?php
require_once('class/offres.class.php');

return array('status_code' => 200, 'message' => '', 'data' => Offres::getOffres($bddConnection));