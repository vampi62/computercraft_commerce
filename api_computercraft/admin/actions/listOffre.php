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
	$req = $this->bdd->query('SELECT * FROM liste_offres');
	$list_offres = array();
	$listidplayer = ConvertTable::gettableidplayer($this->bdd);
	while ($donnees = $req->fetch())
	{
		$adresse = ConvertTable::getIdAdresse($this->bdd,$donnees['id_adresse']);
		$offre = array(1 => $donnees['id']);
		$offre[] = $adresse;
		//$offre[] = $donnees['id_adresse'];
		$offre[] = $listidplayer[$donnees['proprio']];
		$offre[] = $donnees['prix'];
		$offre[] = $donnees['nbr_dispo'];
		$offre[] = $donnees['type'];
		$offre[] = $donnees['livraison'];
		$offre[] = $donnees['nom'];
		$offre[] = $donnees['description'];
		$offre[] = $donnees['last_update'];
		if ($this->proprio == $donnees['proprio'])
		{
			$offre[] = $this->getnbrcommande($donnees['id']);
		}
		else
		{
			$offre[] = 0;
		}
		if (empty($list_offres))
		{
			$list_offres = array(1 => $offre);
		}
		else
		{
			$list_offres[] = $offre;
		}
	}
	$req->closeCursor();
	return $list_offres;
}
?>