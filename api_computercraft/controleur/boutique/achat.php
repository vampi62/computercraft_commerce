<?php
require_once('modele/joueur/connection.class.php');
require_once('modele/boutique/boutique.class.php');
require_once('modele/banque/commande.class.php');
require_once('modele/adresse/adresse.class.php');
require_once('modele/converttable.class.php');

if(isset($_GET['pseudo']) AND isset($_GET['mdp']) AND isset($_GET['id']) AND isset($_GET['quantite']) AND !empty($_GET['pseudo']) AND !empty($_GET['mdp']) AND !empty($_GET['id']) AND !empty($_GET['quantite']))
{
	$_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
	$_GET['mdp'] = htmlspecialchars($_GET['mdp']);
	$_GET['id'] = intval(htmlspecialchars($_GET['id']));
	$_GET['quantite'] = intval(htmlspecialchars($_GET['quantite']));

	$connection = new Connection($_GET['pseudo'], $bddConnection);
	if($connection->verifymdp($_GET['mdp']))
	{
		$_Joueur_ = $connection->getReponseConnection();
		$boutique = new Boutique($_Joueur_, $bddConnection);

		$offreid = $boutique->getOffresbyidachat($_GET['id']);
		if (isset($offreid) AND !empty($offreid))
		{
			if ($offreid['proprio'] != 0 AND $offreid['id_adresse'] != 0 AND $offreid['type'] != 0 AND $offreid['livraison'] != 0 AND $offreid['prix'] != 0 AND $offreid['nom'] != "null" AND $offreid['description'] != "null") {
				$somme = $_GET['quantite'] * $offreid['prix'];
				if ($offreid['nbr_dispo'] > $_GET['quantite'])
				{
					if (0 <= $_GET['quantite'])
					{
						if ($_Joueur_["compte"] > $somme)
						{
							if ($_Joueur_["id"] != $offreid['proprio'])
							{
								$adresse_client = 0;
								if (isset($_GET['adresse']) AND !empty($_GET['adresse'])) // si adresse verifie si present dans la db
								{
									$_GET['adresse'] = htmlspecialchars($_GET['adresse']);
									$adresse = new Adresse($_Joueur_, $bddConnection);
									$idadresse = $adresse->getIdAdresse($_GET['adresse']);
									if(isset($idadresse["id"]) AND !empty($idadresse["id"]))
									{
										if($idadresse["type"] == 1)
										{
											$adresse_client = $_GET['adresse'];
										}
									}
								}
								else // sinon prend l'adresse par defaut
								{
									$adresse_client = $_Joueur_['id_adresse'];
								}
								if ($adresse_client <= 0)
								{
									// modif pas d'adresse de livraison
									$printmessage = 34;
								}
								else
								{
									$text_adresse_expediteur = ConvertTable::getIdAdresse($bddConnection,$offreid['id_adresse']);
									$text_adresse_recepteur = ConvertTable::getIdAdresse($bddConnection,$adresse_client);
									$datatcommande = array();
									$datatcommande["ref_commande"] = $offreid['id'];
									$datatcommande["expediteur"] = $offreid['proprio'];
									$datatcommande["text_adresse_expediteur"] = $text_adresse_expediteur["nom"] . "-" . $text_adresse_expediteur["coo"] . "-" . $text_adresse_expediteur["description"];
									$datatcommande["text_adresse_recepteur"] = $text_adresse_recepteur["nom"] . "-" . $text_adresse_recepteur["coo"] . "-" . $text_adresse_recepteur["description"];
									$datatcommande["nom_commande"] = $offreid['nom'];
									$datatcommande["quantite"] = $_GET['quantite'];
									$datatcommande["somme"] = $somme;
									$datatcommande["prix_unitaire"] = $offreid['prix'];
									$datatcommande["type"] = $offreid['type'];
									$datatcommande["livraison"] = $offreid['livraison'];
									$datatcommande["description"] = $offreid['description'];
									$commande = new Commande($_Joueur_, $bddConnection, $_Serveur_);
									$commande->setCommande($datatcommande);
	
									// modif - ok
									$printmessage = 1;
								}
							}
							else
							{
								// modif - cette offre est a vous
								$printmessage = 32;
							}
						}
						else
						{
							// modif - solde insufisant
							$printmessage = 41;
						}
					}
					else
					{
						// modif - quantité inf a 0
						$printmessage = 31;
					}
				}
				else
				{
					// modif - pas de disponibilité par raport a la demande
					$printmessage = 30;
				}
			}
			else
			{
				// modif - l'offre n'est pas active
				$printmessage = 33;
			}
		}
		else
		{
			// modif - l'offre n'est pas valide
			$printmessage = 33;
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