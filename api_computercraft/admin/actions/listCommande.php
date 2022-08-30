<?php
require_once('modele/joueur/connection.class.php');
require_once('modele/converttable.class.php');

if(isset($_GET['pseudo']) AND isset($_GET['mdp']) AND !empty($_GET['pseudo']) AND !empty($_GET['mdp']))
{
	$_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
	$_GET['mdp'] = htmlspecialchars($_GET['mdp']);

	$connection = new Connection($_GET['pseudo'], $bddConnection);
	if($connection->verifymdp($_GET['mdp']))
	{
		$_Joueur_ = $connection->getReponseConnection();
		if ($_Joueur_['role'] == 10)
		{
			$listecommande = getCommande($bddConnection);
			// modif - print $listecommande
			$printmessage = $listecommande;
		}
		else
		{
			// modif - privilege insuffisant
			$printmessage = 10;
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
function getCommande($bdd)
{
	$req = $bdd->query('SELECT * FROM commandes');
	$list_id = array();
	$list_id_offre = array();
	$list_id_transaction = array();
	$list_nom_commande = array();
	$list_expediteur = array();
	$list_recepteur = array();
	$list_text_adresse_expediteur = array();
	$list_text_adresse_recepteur = array();
	$list_quantite = array();
	$list_somme = array();
	$list_prix_unitaire = array();
	$list_type = array();
	$list_livraison = array();
	$list_suivie = array();
	$list_description = array();
	$list_statut = array();
	$list_date = array();
	$list_heure = array();

	$listidplayer = ConvertTable::gettableidplayer($bdd);
	while ($donnees = $req->fetch())
	{
		$list_id[] = $donnees['id'];
		$list_id_offre[] = $donnees['id_offre'];
		$list_id_transaction[] = $donnees['id_transaction'];
		$list_nom_commande[] = $donnees['nom_commande'];
		$list_expediteur[] = $listidplayer[$donnees['expediteur']];
		$list_recepteur[] = $listidplayer[$donnees['recepteur']];
		$list_text_adresse_expediteur[] = $donnees['text_adresse_expediteur'];
		$list_text_adresse_recepteur[] = $donnees['text_adresse_recepteur'];
		$list_quantite[] = $donnees['quantite'];
		$list_somme[] = $donnees['somme'];
		$list_prix_unitaire[] = $donnees['prix_unitaire'];
		$list_type[] = $donnees['type'];
		$list_livraison[] = $donnees['livraison'];
		$list_suivie[] = $donnees['suivie'];
		$list_description[] = $donnees['description'];
		$list_statut[] = $donnees['statut'];
		$list_date[] = $donnees['date'];
		$list_heure[] = $donnees['heure'];
	}
	$req->closeCursor();
	return array($list_id,$list_id_offre,$list_id_transaction,$list_nom_commande,$list_expediteur,$list_recepteur,$list_text_adresse_expediteur,$list_text_adresse_recepteur,$list_quantite,$list_somme,$list_prix_unitaire,$list_type,$list_livraison,$list_suivie,$list_description,$list_statut,$list_date,$list_heure);
}
?>