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
			$listetransaction = getTransactionListe($bddConnection);
			// modif - print $listetransaction
			$printmessage = $listetransaction;
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
function getTransactionListe($bdd)
{
	$req = $bdd->query('SELECT * FROM transactions');
	$list_id = array();
	$list_id_commandes = array();
	$list_id_admin_exec = array();
	$list_crediteur = array();
	$list_debiteur = array();
	$list_somme = array();
	$list_type = array();
	$list_description = array();
	$list_statut = array();
	$list_date = array();
	$list_heure = array();

	$listidplayer = ConvertTable::gettableidplayer($bdd);
	while ($donnees = $req->fetch())
	{
		$list_id[] = $donnees['id'];
		$list_id_commandes[] = $donnees['id_commandes'];
		$list_id_admin_exec[] = $listidplayer[$donnees['id_admin_exec']];
		$list_crediteur[] = $listidplayer[$donnees['crediteur']];
		$list_debiteur[] = $listidplayer[$donnees['debiteur']];
		$list_somme[] = $donnees['somme'];
		$list_type[] = $donnees['type'];
		$list_description[] = $donnees['description'];
		$list_statut[] = $donnees['statut'];
		$list_date[] = $donnees['date'];
		$list_heure[] = $donnees['heure'];
	}
	$req->closeCursor();
	return array($list_id,$list_id_commandes,$list_id_admin_exec,$list_crediteur,$list_debiteur,$list_somme,$list_type,$list_description,$list_statut,$list_date,$list_heure);
}
?>