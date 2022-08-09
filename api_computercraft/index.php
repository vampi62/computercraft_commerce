<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, "fr_FR");

require ('controleur/config.php');
require ('controleur/connection_base.php');
if (!$_Serveur_['Install']) header('Location: installation/');
if (isset($_GET['action']))
{
	if (isset($_GET['admin']))
	{
		require ('admin/action.php');
	}
	else
	{
		require ('controleur/action.php');
	}

}
require ('theme/vue.php');
?>