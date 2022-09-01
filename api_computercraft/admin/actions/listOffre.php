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
			$listeboutique = getOffres($bddConnection);
			// modif - print $listeboutique
			$printmessage = $listeboutique;
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
function getOffres($bdd)
{
	$req = $bdd->query('SELECT * FROM liste_offres');
	$list_id = array();
	$list_id_adresse = array();
	$list_proprio = array();
	$list_prix = array();
	$list_nbr_dispo = array();
	$list_type = array();
	$list_livraison = array();
	$list_nom = array();
	$list_description = array();
	$list_statut = array();
	$list_last_update = array();

	$listidplayer = ConvertTable::gettableidplayer($bdd);
	while ($donnees = $req->fetch())
	{
		$adresse = ConvertTable::getIdAdresse($bdd,$donnees['id_adresse']);
		$list_id[] = $donnees['id'];
		$list_id_adresse[] = $adresse;
		$list_proprio[] = $listidplayer[$donnees['proprio']];
		$list_prix[] = $donnees['prix'];
		$list_nbr_dispo[] = $donnees['nbr_dispo'];
		$list_type[] = $donnees['type'];
		$list_livraison[] = $donnees['livraison'];
		$list_nom[] = $donnees['nom'];
		$list_description[] = $donnees['description'];
		$list_last_update[] = $donnees['last_update'];
	}
	$req->closeCursor();
	return array($list_id,$list_id_adresse,$list_proprio,$list_prix,$list_nbr_dispo,$list_type,$list_livraison,$list_nom,$list_description,$list_last_update);
}
?>