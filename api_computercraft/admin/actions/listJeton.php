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
			$listejeton = getJeton($bddConnection);
			// modif - print $listejeton
			$printmessage = $listejeton;
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
function getJeton($bdd)
{
	$req = $bdd->query('SELECT * FROM jeton_banque');
	$list_id_user = array();
	$list_jeton1 = array();
	$list_jeton10 = array();
	$list_jeton100 = array();
	$list_jeton1k = array();
	$list_jeton10k = array();
	$list_date = array();
	$list_heure = array();

	$listidplayer = ConvertTable::gettableidplayer($bdd);
	while ($donnees = $req->fetch())
	{
		$list_id_user[] = $listidplayer[$donnees['id_user']];
		$list_jeton1[] = $donnees['jeton1'];
		$list_jeton10[] = $donnees['jeton10'];
		$list_jeton100[] = $donnees['jeton100'];
		$list_jeton1k[] = $donnees['jeton1k'];
		$list_jeton10k[] = $donnees['jeton10k'];
		$list_date[] = $donnees['date'];
		$list_heure[] = $donnees['heure'];
	}
	$req->closeCursor();
	return array($list_id_user,$list_jeton1,$list_jeton10,$list_jeton100,$list_jeton1k,$list_jeton10k,$list_date,$list_heure);
}
?>