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
		$text_adresse = ConvertTable::getIdAdresse($bddConnection,$_Joueur_['id_adresse']);
		// modif - print $_Joueur_
		$printmessage = array();
		$printmessage['pseudo'] = $_Joueur_['pseudo'];
		$printmessage['email'] = $_Joueur_['email'];
		$printmessage['compte'] = $_Joueur_['compte'];
		$printmessage['adrnom'] = $text_adresse["nom"];
		$printmessage['adrtype'] = $text_adresse["type"];
		$printmessage['adrcoo'] = $text_adresse["coo"];
		$printmessage['adrdescription'] = $text_adresse["description"];
		$printmessage['nbr_offre'] = $_Joueur_['nbr_offre'];
		$printmessage['role'] = $_Joueur_['role'];
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