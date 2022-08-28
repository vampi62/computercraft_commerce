<?php
require_once('modele/joueur/connection.class.php');
require_once('modele/joueur/maj.class.php');
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
		if(isset($idadresse["id"]) AND !empty($idadresse["id"]))
		{
			if($idadresse["type"] == 1)
			{
				$maj = new Maj($_Joueur_, $bddConnection);
				$maj->setNouvellesDonneesIdAdresse($idadresse["id"]);
				// modif - ok
				$printmessage = 1;
			}
			else
			{
				// nom adresse utiliser pour le commerce
				$printmessage = 72;
			}
		}
		else
		{
			// nom adresse inexistant
			$printmessage = 70;
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