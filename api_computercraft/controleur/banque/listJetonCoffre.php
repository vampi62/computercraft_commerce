<?php
require_once('modele/joueur/connection.class.php');
require_once('modele/banque/jeton.class.php');
require_once('modele/converttable.class.php');

if(isset($_GET['pseudo']) AND isset($_GET['mdp']) AND !empty($_GET['pseudo']) AND !empty($_GET['mdp']))
{
	$_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
	$_GET['mdp'] = htmlspecialchars($_GET['mdp']);

	$connection = new Connection($_GET['pseudo'], $bddConnection);
	if($connection->verifymdp($_GET['mdp']))
	{
		$_Joueur_ = $connection->getReponseConnection();
		$jeton = new Jeton($_Joueur_, $bddConnection);
		if($_Joueur_['role'] == 1)
		{
			$listejeton = $jeton->getJeton();
			// modif - ok
			$printmessage = $listejeton;
		}
		else
		{
			// modif - privilege incorrect
			$printmessage = 10;
		}
	}
	else
	{
		// modif - le mot de passe admin est incorrect
		$printmessage = 12;
	}
}
else
{
	// modif - il manque des parametres
	$printmessage = 13;
}
?>