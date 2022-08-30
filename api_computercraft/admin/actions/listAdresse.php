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
			$listeadresse = getAdresse($bddConnection);
			// modif - print $listeadresse
			$printmessage = $listeadresse;
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
function getAdresse($bdd)
{
	$req = $bdd->query('SELECT * FROM liste_adresses');
	$list_id = array();
	$list_proprio = array();
	$list_nom = array();
	$list_type = array();
	$list_coo = array();
	$list_description = array();
	$listidplayer = ConvertTable::gettableidplayer($bdd);
	while ($donnees = $req->fetch())
	{
		$list_id[] = $donnees['id'];
		$list_proprio[] = $listidplayer[$donnees['proprio']];
		$list_nom[] = $donnees['nom'];
		$list_type[] = $donnees['type'];
		$list_coo[] = $donnees['coo'];
		$list_description[] = $donnees['description'];
	}
	$req->closeCursor();
	return array($list_id,$list_proprio,$list_nom,$list_type,$list_coo,$list_description);
}
?>