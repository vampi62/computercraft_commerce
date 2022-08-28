<?php
require_once('modele/joueur/connection.class.php');
require_once('modele/adresse/adresse.class.php');

if(isset($_GET['pseudo']) AND isset($_GET['nom']) AND isset($_GET['mdp']) AND !empty($_GET['pseudo']) AND !empty($_GET['nom']) AND !empty($_GET['mdp']))
{
	$_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
	$_GET['nom'] = htmlspecialchars($_GET['nom']);
	$_GET['mdp'] = htmlspecialchars($_GET['mdp']);

	$connection = new Connection($_GET['pseudo'], $bddConnection);
	if($connection->verifymdp($_GET['mdp']))
	{
		$_Joueur_ = $connection->getReponseConnection();

		$adresse = new Adresse($_Joueur_, $bddConnection);
		$idadresse = $adresse->getIdAdresse($_GET['nom']);
		if(empty($idadresse["id"]))
		{
			if(isset($_GET['nom']) AND isset($_GET['type']) AND isset($_GET['coo']) AND isset($_GET['descriptidon']) AND !empty($_GET['nom']) AND !empty($_GET['coo']) AND !empty($_GET['description']))
			{
				$_GET['nom'] = htmlspecialchars($_GET['nom']);
				$_GET['type'] = intval(htmlspecialchars($_GET['type']));
				$_GET['coo'] = htmlspecialchars($_GET['coo']);
				$_GET['description'] = htmlspecialchars($_GET['description']);
				if ($_GET['type'] < 0)
				{
					$_GET['type'] = 0;
				}
				if ($_GET['type'] > 2)
				{
					$_GET['type'] = 2;
				}
				$adresse->addAdresse($_GET['nom'],$_GET['type'],$_GET['coo'],$_GET['description']);
				// modif - ok
				$printmessage = 1;
			}
			else
			{
				// il manque des parametres
				$printmessage = 13;
			}
		}
		else
		{
			// modif - nom adresse déjà utiliser
			$printmessage = 71;
		}
	}
	else
	{
		// modif - le mot de passe est incorrect
		$printmessage = 11;
	}
}
else
{
	// modif - il manque des parametres
	$printmessage = 13;
}
?>