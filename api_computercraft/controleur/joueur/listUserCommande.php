<?php
require_once('modele/joueur/connection.class.php');
require_once('modele/banque/commande.class.php');
require_once('modele/converttable.class.php');

if(isset($_GET['pseudo']) AND isset($_GET['mdp']) AND !empty($_GET['pseudo']) AND !empty($_GET['mdp']))
{
	$_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
	$_GET['mdp'] = htmlspecialchars($_GET['mdp']);
   
	$connection = new Connection($_GET['pseudo'], $bddConnection);
	if($connection->verifymdp($_GET['mdp']))
	{
		$_Joueur_ = $connection->getReponseConnection();
		$commande = new Commande($_Joueur_, $bddConnection, $_Serveur_);
		$listecommande = $commande->getCommandeClient();
		// modif - print $listecommande
		$printmessage = $listecommande;
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