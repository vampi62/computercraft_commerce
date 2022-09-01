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
			$listeuser = getUser($bddConnection);
			// modif - print $listeuser
			$printmessage = $listeuser;
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
function getUser($bdd)
{
	$req = $bdd->query('SELECT * FROM liste_users');
	$list_pseudo = array();
	$list_compte = array();
	$list_id_adresse = array();
	$list_nbr_offre = array();
	$list_role = array();
	$list_last_login = array();

	while ($donnees = $req->fetch())
	{
		$text_adresse = ConvertTable::getIdAdresse($bdd,$donnees['id_adresse']);
		$list_pseudo[] = $donnees['pseudo'];
		$list_compte[] = $donnees['compte'];
		$list_id_adresse[] = $text_adresse;
		$list_nbr_offre[] = $donnees['nbr_offre'];
		$list_role[] = $donnees['role'];
		$list_last_login[] = $donnees['last_login'];
	}
	$req->closeCursor();
	return array($list_pseudo,$list_compte,$list_id_adresse,$list_nbr_offre,$list_role,$list_last_login);
}
?>