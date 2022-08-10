<?php
require_once('modele/joueur/connection.class.php');
require_once('modele/joueur/maj.class.php');
require_once('modele/banque/commande.class.php');
require_once('modele/banque/transaction.class.php');
require_once('modele/changetext.class.php');

if(isset($_GET['pseudo']) AND isset($_GET['type']) AND isset($_GET['mdp']) AND !empty($_GET['pseudo']) AND !empty($_GET['type']) AND !empty($_GET['mdp']))
{
	$_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
	$_GET['mdp'] = htmlspecialchars($_GET['mdp']);
	$_GET['type'] = htmlspecialchars($_GET['type']);
	$formcomplet = true;
	if($_GET['type'] != "commande")
	{
		if(isset($_GET['crediteur']) AND isset($_GET['debiteur']) AND isset($_GET['mdpuser']) AND isset($_GET['somme']) AND isset($_GET['description']) AND !empty($_GET['crediteur']) AND !empty($_GET['debiteur']) AND !empty($_GET['mdpuser']) AND !empty($_GET['somme']) AND !empty($_GET['description']))
		{
			$_GET['crediteur'] = htmlspecialchars($_GET['crediteur']);
			$_GET['debiteur'] = htmlspecialchars($_GET['debiteur']);
			$_GET['mdpuser'] = htmlspecialchars($_GET['mdpuser']);
			$_GET['somme'] = htmlspecialchars($_GET['somme']);
			$_GET['description'] = htmlspecialchars($_GET['description']);
			$_GET['description'] = Changetext::retirebalise($_GET['description'],$_Serveur_);

			if ($_GET['type'] == "depot")
			{
				$connectionuser = new Connection($_GET['crediteur'], $bddConnection);
			}
			else
			{
				$connectionuser = new Connection($_GET['debiteur'], $bddConnection);
			}
			if(!$connectionuser->verifymdp($_GET['mdpuser']))
			{
				// modif - mot de passe incrorrect
				$printmessage = 11;
				$formcomplet = false;
			}
		}
		else
		{
			// modif - il manque des parametres
			$printmessage = 13;
			$formcomplet = false;
		}
	}

	$connection = new Connection($_GET['pseudo'], $bddConnection);
	if($connection->verifymdp($_GET['mdp']))
	{
		if ($formcomplet)
		{
			$_Joueur_ = $connection->getReponseConnection();
			switch($_GET['type'])
			{
				case "commande":
					if ($_Joueur_['role'] == 2)
					{
						$commande = new Commande($_Joueur_, $bddConnection, $_Serveur_);
						$listecommande = $commande->getCommandeBanque();
						if(!empty($listecommande))
						{
							$compte_expediteur = new Connection(intval($listecommande['expediteur']), $bddConnection);
							$compte_recepteur = new Connection(intval($listecommande['recepteur']), $bddConnection);
							$_compte_expediteur_ = $compte_expediteur->getReponseConnection();
							$_compte_recepteur_ = $compte_recepteur->getReponseConnection();
							if($_compte_recepteur_["compte"] >= $listecommande['somme'])
							{
								$majDebiteur = new Maj($_compte_recepteur_, $bddConnection);
								$majCrediteur = new Maj($_compte_expediteur_, $bddConnection);
								$majDebiteur->setNouvellesDonneesCompte($_compte_recepteur_["compte"]-$listecommande['somme']);
								$majCrediteur->setNouvellesDonneesCompte($_compte_expediteur_["compte"]+$listecommande['somme']);
								$statut = "transaction valider";
								$commerce_statut = 3;
								// modif - ok
								$printmessage = 1;
							}
							else
							{
								$statut = "transaction refuser";
								$commerce_statut = 11;
								// solde insufisant
								$printmessage = 41;
							}
							$transaction = new Transaction($_Joueur_, $bddConnection);
							$datatransaction = array();
							$datatransaction["ref_commande"] = $listecommande['id'];
							$datatransaction["crediteur"] = $_compte_expediteur_['id'];
							$datatransaction["debiteur"] = $_compte_recepteur_['id'];
							$datatransaction["somme"] = $listecommande['somme'];
							$datatransaction["type"] = $_GET['type'];
							$datatransaction["description"] = $listecommande['description'];
							$datatransaction["statut"] = $statut;
							$id_transaction = $transaction->setTransaction($datatransaction);
							$commande->setLinktansactionCommande($listecommande['id'],$id_transaction);
							$commande->setstatutCommande($listecommande['id'],$commerce_statut,true);
						}
						else
						{
							// pas de transaction
							$printmessage = 60;
						}
					}
					else
					{
						// modif - privilege insufisant
						$printmessage = 10;
					}
				break;
				case "transfert":
					if ($_Joueur_['role'] == 1)
					{
						$compte_crediteur = new Connection($_GET['crediteur'], $bddConnection);
						$compte_debiteur = new Connection($_GET['debiteur'], $bddConnection);
						$_compte_crediteur_ = $compte_crediteur->getReponseConnection();
						$_compte_debiteur_ = $compte_debiteur->getReponseConnection();
						if($_compte_debiteur_["compte"] >= $_GET['somme'])
						{
							$majDebiteur = new Maj($_compte_debiteur_, $bddConnection);
							$majCrediteur = new Maj($_compte_crediteur_, $bddConnection);
							$majDebiteur->setNouvellesDonneesCompte($_compte_debiteur_["compte"]-$_GET['somme']);
							$majCrediteur->setNouvellesDonneesCompte($_compte_crediteur_["compte"]+$_GET['somme']);
							$statut = "transfert valider";
							// modif - ok
							$printmessage = 1;
						}
						else
						{
							$statut = "transfert refuser";
							// solde insufisant
							$printmessage = 41;
						}
						$transaction = new Transaction($_Joueur_, $bddConnection);
						$datatransaction = array();
						$datatransaction["ref_commande"] = 0;
						$datatransaction["crediteur"] = $_compte_crediteur_['id'];
						$datatransaction["debiteur"] = $_compte_debiteur_['id'];
						$datatransaction["somme"] = $_GET['somme'];
						$datatransaction["type"] = $_GET['type'];
						$datatransaction["description"] = $_GET['description'];
						$datatransaction["statut"] = $statut;
						$id_transaction = $transaction->setTransaction($datatransaction);
					}
					else
					{
						// modif - privilege insufisant
						$printmessage = 10;
					}
				break;
				case "depot":
					if ($_Joueur_['role'] == 1)
					{
						$compte_crediteur = new Connection($_GET['crediteur'], $bddConnection);
						$_compte_crediteur_ = $compte_crediteur->getReponseConnection();
						$majCrediteur = new Maj($_compte_crediteur_, $bddConnection);
						$majCrediteur->setNouvellesDonneesCompte($_compte_crediteur_["compte"]+$_GET['somme']);
						$statut = "depot valider";
						$transaction = new Transaction($_Joueur_, $bddConnection);
						$datatransaction = array();
						$datatransaction["ref_commande"] = 0;
						$datatransaction["crediteur"] = $_compte_crediteur_['id'];
						$datatransaction["debiteur"] = $_Joueur_['id'];
						$datatransaction["somme"] = $_GET['somme'];
						$datatransaction["type"] = $_GET['type'];
						$datatransaction["description"] = $_GET['description'];
						$datatransaction["statut"] = $statut;
						$id_transaction = $transaction->setTransaction($datatransaction);
						// modif - ok
						$printmessage = 1;
					}
					else
					{
						// modif - privilege insufisant
						$printmessage = 10;
					}
				break;
				case "retrait":
					if ($_Joueur_['role'] == 1)
					{
						$compte_debiteur = new Connection($_GET['debiteur'], $bddConnection);
						$_compte_debiteur_ = $compte_debiteur->getReponseConnection();
						if($_compte_debiteur_["compte"] >= $_GET['somme'])
						{
							$majDebiteur = new Maj($_compte_debiteur_, $bddConnection);
							$majDebiteur->setNouvellesDonneesCompte($_compte_debiteur_["compte"]-$_GET['somme']);
							$statut = "retrait valider";
							// modif - ok
							$printmessage = 1;
						}
						else
						{
							$statut = "retrait refuser";
							// solde insufisant
							$printmessage = 41;
						}
						$transaction = new Transaction($_Joueur_, $bddConnection);
						$datatransaction = array();
						$datatransaction["ref_commande"] = 0;
						$datatransaction["crediteur"] = $_Joueur_['id'];
						$datatransaction["debiteur"] = $_compte_debiteur_['id'];
						$datatransaction["somme"] = $_GET['somme'];
						$datatransaction["type"] = $_GET['type'];
						$datatransaction["description"] = $_GET['description'];
						$datatransaction["statut"] = $statut;
						$id_transaction = $transaction->setTransaction($datatransaction);
					}
					else
					{
						// modif - privilege insufisant
						$printmessage = 10;
					}
				break;
				case "achatoffre":
					if ($_Joueur_['role'] == 1)
					{
						require_once('modele/boutique/boutique.class.php');
						
						$compte_debiteur = new Connection($_GET['debiteur'], $bddConnection);
						$_compte_debiteur_ = $compte_debiteur->getReponseConnection();
						if ($_compte_debiteur_["nbr_offre"] + $_GET['somme'] > $_Serveur_['General']['max_offre'])
						{
							$_GET['somme'] = $_Serveur_['General']['max_offre'] - $_compte_debiteur_["nbr_offre"];
						}
						$prix_global = $_Serveur_['General']['prix_offre'] * $_GET['somme'];
						if($_compte_debiteur_["compte"] >= $prix_global AND $_GET['somme'] > 0)
						{
							$boutique = new Boutique($_compte_debiteur_, $bddConnection);
							$majDebiteur = new Maj($_compte_debiteur_, $bddConnection);
							$majDebiteur->setNouvellesDonneesCompte($_compte_debiteur_["compte"]-$prix_global);
							for ($j=0; $j < $_GET['somme']; $j++) {
								$boutique->setNouvellesOffre();
							}
							$majDebiteur->setNouvellesDonneesNbrOffre($boutique->getnbrOffres());

							$statut = "achat offre valider";
							// modif - ok
							$printmessage = 1;
						}
						elseif ($_GET['somme'] <= 0)
						{
							
							$statut = "achat offre refuser limite";
							// limite offre atteint
							$printmessage = 42;
						}
						else
						{
							$statut = "achat offre refuser";
							// solde insufisant
							$printmessage = 41;
						}
						$transaction = new Transaction($_Joueur_, $bddConnection);
						$datatransaction = array();
						$datatransaction["ref_commande"] = 0;
						$datatransaction["crediteur"] = $_Joueur_['id'];
						$datatransaction["debiteur"] = $_compte_debiteur_['id'];
						$datatransaction["somme"] = $_GET['somme'];
						$datatransaction["type"] = $_GET['type'];
						$datatransaction["description"] = $_GET['description'];
						$datatransaction["statut"] = $statut;
						$id_transaction = $transaction->setTransaction($datatransaction);
					}
					else
					{
						// modif - privilege insufisant
						$printmessage = 10;
					}
				break;
			}
		}
	}
	else
	{
		// modif - le mot de passe est incorrect
		$printmessage = 12;
	}
}
else
{
	// modif - il manque des parametres
	$printmessage = 13;
}
?>