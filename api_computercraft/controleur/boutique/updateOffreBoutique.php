<?php
require_once('modele/joueur/connection.class.php');
require_once('modele/boutique/boutique.class.php');
require_once('modele/adresse/adresse.class.php');

if(isset($_GET['pseudo']) AND isset($_GET['mdp']) AND isset($_GET['id']) AND !empty($_GET['pseudo']) AND !empty($_GET['mdp']) AND !empty($_GET['id']))
{
	$_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
	$_GET['mdp'] = htmlspecialchars($_GET['mdp']);
	$_GET['id'] = intval(htmlspecialchars($_GET['id']));

	$connection = new Connection($_GET['pseudo'], $bddConnection);
	if($connection->verifymdp($_GET['mdp']))
	{
		$_Joueur_ = $connection->getReponseConnection();
		$boutique = new Boutique($_Joueur_, $bddConnection);
		$offreid = $boutique->getOffresbyid($_GET['id']);
		if(!empty($offreid['proprio']))
		{
			$printmessage = array();
			if(isset($_GET['prix']))
			{
				$_GET['prix'] = floatval(htmlspecialchars($_GET['prix']));
				if ($_GET['prix'] >= 0)
				{
					$boutique->setNouvellesDonneesPrix($_GET['prix'],$_GET['id']);
					// modif - ok
					$printmessage[] = 1;
				}
				else
				{
					// modif prix incorrect
					$printmessage[] = 52;
				}
			}
			else
			{
				// modif pas de retour attendu
				$printmessage[] = 0;
			}
			if(isset($_GET['nbr_dispo']))
			{
				$_GET['nbr_dispo'] = intval(htmlspecialchars($_GET['nbr_dispo']));
				if ($_GET['nbr_dispo'] >= 0)
				{
					$boutique->setNouvellesDonneesNbrDispo($_GET['nbr_dispo'],$_GET['id']);
					// modif - ok
					$printmessage[] = 1;
				}
				else
				{
					// modif nbr_dispo incorrect
					$printmessage[] = 53;
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
				$boutique->setNouvellesDonneesType($_GET['type'],$_GET['id']);
				// modif - ok
				$printmessage[] = 1;
			}
			else
			{
				// modif pas de retour attendu
				$printmessage[] = 0;
			}
			if(isset($_GET['livraison']))
			{
				$_GET['livraison'] = intval(htmlspecialchars($_GET['livraison']));
				if ($_GET['livraison'] < 0)
				{
					$_GET['livraison'] = 0;
				}
				$boutique->setNouvellesDonneesLivraison($_GET['livraison'],$_GET['id']);
				// modif - ok
				$printmessage[] = 1;
			}
			else
			{
				// modif pas de retour attendu
				$printmessage[] = 0;
			}
			if(isset($_GET['nom']))
			{
				$_GET['nom'] = htmlspecialchars($_GET['nom']);
				$boutique->setNouvellesDonneesNom($_GET['nom'],$_GET['id']);
				// modif - ok
				$printmessage[] = 1;
			}
			else
			{
				// modif pas de retour attendu
				$printmessage[] = 0;
			}
			if(isset($_GET['nomadresse']))
			{
				$_GET['nomadresse'] = htmlspecialchars($_GET['nomadresse']);
				$adresse = new Adresse($_Joueur_, $bddConnection);
				$idadresse = $adresse->getIdAdresse($_GET['nomadresse']);
				if(isset($idadresse["id"]))
				{
					if(empty($_GET['nomadresse']))
					{
						$boutique->setNouvellesDonneesIdAdresse(0,$_GET['id']);
						// modif - ok
						$printmessage[] = 1;
					}
					elseif($idadresse["type"] == 2)
					{
						$boutique->setNouvellesDonneesIdAdresse($idadresse["id"],$_GET['id']);
						// modif - ok
						$printmessage[] = 1;
					}
					else
					{
						// nom adresse utiliser pour la reception
						$printmessage[] = 73;
					}
				}
				else
				{
					// nom adresse inexistant
					$printmessage[] = 70;
				}
			}
			else
			{
				// modif pas de retour attendu
				$printmessage[] = 0;
			}
			if(isset($_GET['description']))
			{
				$_GET['description'] = htmlspecialchars($_GET['description']);
				$boutique->setNouvellesDonneesDescription($_GET['description'],$_GET['id']);
				// modif - ok
				$printmessage[] = 1;
			}
			else
			{
				// modif pas de retour attendu
				$printmessage[] = 0;
			}
			$boutique->setNouvellesDonneesLastUpdate($_GET['id']);
		}
		else
		{
			// modif - l'id n'est pas a vous
			$printmessage = 51;
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