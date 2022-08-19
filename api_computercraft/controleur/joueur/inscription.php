<?php
require_once('modele/joueur/connection.class.php');
require_once('modele/joueur/inscription.class.php');
require_once('modele/boutique/boutique.class.php');

if(isset($_GET['pseudo']) AND isset($_GET['mdp']) AND isset($_GET['mdpconfirm']) AND isset($_GET['email']) AND !empty($_GET['pseudo']) AND !empty($_GET['mdp']) AND !empty($_GET['mdpconfirm']) AND !empty($_GET['email']))
{
	$_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
	$_GET['mdp'] = htmlspecialchars($_GET['mdp']);
	$_GET['mdpconfirm'] = htmlspecialchars($_GET['mdpconfirm']);
	$_GET['email'] = htmlspecialchars($_GET['email']);

	if (preg_match('@[A-Z]@', $_GET['mdp']) AND preg_match('@[a-z]@', $_GET['mdp']) AND preg_match('@[0-9]@', $_GET['mdp']) AND strlen($_GET['mdp']) > 8)
	{
		if($_GET['mdp'] == $_GET['mdpconfirm'])
		{
			if(filter_var($_GET['email'], FILTER_VALIDATE_EMAIL))
			{
				$connection = new Connection($_GET['pseudo'], $bddConnection);
				$donneesJoueur = $connection->getReponseConnection();
				if(empty($donneesJoueur['pseudo']))
				{
					$_GET['pseudo'] = Changetext::retirebalise($_GET['pseudo'],$_Serveur_);
					$inscription = new Inscription($_GET['pseudo'], $_GET['mdp'], $_GET['email'], $bddConnection, $_Serveur_);
					$boutique = new Boutique($inscription->getnewid($_GET['pseudo']), $bddConnection);
					for ($j=0; $j < $_Serveur_['General']['offre_depart']; $j++)
					{
						$boutique->setNouvellesOffre();
					}
					$inscription->setNbrOffre($boutique->getnbrOffres());
					$printmessage = 1;
					// modif - ok
				}
				else
				{
					// modif - un compte existe deja
					$printmessage = 20;
				}
			}
			else
			{
				// modif - mail invalide
				$printmessage = 22;
			}
		}
		else
		{
			// modif - le mot de passe n'est pas identique
			$printmessage = 21;
		}
	}
	else
	{
		// modif - le mot de passe ne respecte pas les regles de securite
		$printmessage = 23;
	}
}
else
{
	// modif - il manque des parametres
	$printmessage = 13;
}
?>
