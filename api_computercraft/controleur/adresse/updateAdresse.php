<?php
require_once('modele/joueur/connection.class.php');
require_once('modele/adresse/adresse.class.php');
require_once('modele/converttable.class.php');

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
			$printmessage = array();
			if(isset($_GET['nouveaunom']))
			{
				$_GET['nouveaunom'] = htmlspecialchars($_GET['nouveaunom']);
				$idnewadresse = $adresse->getIdAdresse($_GET['nouveaunom']);
				if (empty($idnewadresse["id"]))
				{
					$adresse->setNouvellesDonneesNom($idadresse['id'],$_GET['nouveaunom']);
					// modif - ok
					$printmessage[] = 1;
				}
				else
				{
					// nom adresse déjà utiliser
					$printmessage[] = 71;
				}
			}
			else
			{
				// modif pas de retour attendu
				$printmessage[] = 0;
			}
			if(isset($_GET['type']))
			{
				$_GET['type'] = intval(htmlspecialchars($_GET['type']));
				if ($_GET['type'] < 0)
				{
					$_GET['type'] = 0;
				}
				if ($_GET['type'] > 2)
				{
					$_GET['type'] = 2;
				}
				if ($_GET['type'] == 2)
				{
					if ($idadresse["id"] == $_Joueur_['id_adresse'])
					{
						// modif - changement type adresse impossible en cours d'utilisation
						$printmessage[] = 74;
					}
					else
					{
						$adresse->setNouvellesDonneesType($idadresse["id"],$_GET['type']);
						// modif - ok
						$printmessage[] = 1;
					}
				}
				else
				{
					if (ConvertTable::offreUsedId($bddConnection,$idadresse["id"]))
					{
						// modif - changement type adresse impossible en cours d'utilisation
						$printmessage[] = 74;
					}
					else
					{
						$adresse->setNouvellesDonneesType($idadresse["id"],$_GET['type']);
						// modif - ok
						$printmessage[] = 1;
					}
				}
				
			}
			else
			{
				// modif pas de retour attendu
				$printmessage[] = 0;
			}
			if(isset($_GET['coo']))
			{
				$_GET['coo'] = htmlspecialchars($_GET['coo']);
				$adresse->setNouvellesDonneesCoo($idadresse["id"],$_GET['coo']);
				// modif - ok
				$printmessage[] = 1;
			}
			else
			{
				// modif pas de retour attendu
				$printmessage[] = 0;
			}
			if(isset($_GET['description']) AND !empty($_GET['description']))
			{
				$_GET['description'] = htmlspecialchars($_GET['description']);
				$adresse->setNouvellesDonneesDescription($idadresse["id"],$_GET['description']);
				// modif - ok
				$printmessage[] = 1;
			}
			else
			{
				// modif pas de retour attendu
				$printmessage[] = 0;
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