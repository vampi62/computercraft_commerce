<?php
require_once('modele/joueur/connection.class.php');
require_once('modele/banque/commande.class.php');

if(isset($_GET['pseudo']) AND isset($_GET['mdp']) AND isset($_GET['statuts']) AND isset($_GET['id']) AND !empty($_GET['pseudo']) AND !empty($_GET['mdp']) AND !empty($_GET['statuts']) AND !empty($_GET['id']))
{
	$_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
	$_GET['mdp'] = htmlspecialchars($_GET['mdp']);
	$_GET['statuts'] = htmlspecialchars($_GET['statuts']);
	$_GET['id'] = htmlspecialchars($_GET['id']);
   
    $connection = new Connection($_GET['pseudo'], $bddConnection);
    if($connection->verifymdp($_GET['mdp']))
    {
        $_Joueur_ = $connection->getReponseConnection();
        $commande = new Commande($_Joueur_, $bddConnection, $_Serveur_);
		$patern = $commande->setStatusCommande($_GET['id'],$_GET['statuts']);
		if($patern) {
			// modif - ok
			$printmessage = 1;
		}
		else
		{
			// modif - changement invalide
			$printmessage = 40;
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
?>