<?php
require_once('modele/joueur/connection.class.php');
require_once('modele/banque/adresse.class.php');
require_once('modele/changetext.class.php');

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
			if(isset($_GET['nom']) AND isset($_GET['type']) AND isset($_GET['coo']) AND isset($_GET['description']) AND !empty($_GET['nom']) AND !empty($_GET['type']) AND !empty($_GET['coo']) AND !empty($_GET['description']))
			{
				$_GET['nom'] = htmlspecialchars($_GET['nom']);
				$_GET['type'] = htmlspecialchars($_GET['type']);
				$_GET['coo'] = htmlspecialchars($_GET['coo']);
				$_GET['description'] = htmlspecialchars($_GET['description']);
				$_GET['nom'] = Changetext::retirebalise($_GET['nom'],$_Serveur_);
				$_GET['coo'] = Changetext::retirebalise($_GET['coo'],$_Serveur_);
				$_GET['description'] = Changetext::retirebalise($_GET['description'],$_Serveur_);
				$adresse->addAdresse($_GET['nom'],$_GET['type'],$_GET['coo'],$_GET['description']);
				// modif - ok
				$printmessage = 1;
			}
			else
			{
				// nom adresse inexistant
				$printmessage = 71;
			}
		}
		else
		{
			// modif - il manque des parametres
			$printmessage = 13;
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