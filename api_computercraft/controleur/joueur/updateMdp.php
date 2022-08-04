<?php
require_once('modele/joueur/connection.class.php');
require_once('modele/joueur/maj.class.php');

if(isset($_GET['pseudo']) AND isset($_GET['mdpnouveau']) AND isset($_GET['mdp']) AND isset($_GET['mdpconfirm']) AND !empty($_GET['pseudo']) AND !empty($_GET['mdpnouveau']) AND !empty($_GET['mdp']) AND !empty($_GET['mdpconfirm']))
{
	$_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
	$_GET['mdpnouveau'] = htmlspecialchars($_GET['mdpnouveau']);
	$_GET['mdp'] = htmlspecialchars($_GET['mdp']);
	$_GET['mdpconfirm'] = htmlspecialchars($_GET['mdpconfirm']);

	$connection = new Connection($_GET['pseudo'], $bddConnection);
	if(preg_match('@[A-Z]@', $_GET['mdp']) && preg_match('@[a-z]@', $_GET['mdp']) && preg_match('@[0-9]@', $_GET['mdp']) && strlen($_GET['mdp']) > 8)
	{
		if($_GET['mdpnouveau'] == $_GET['mdpconfirm'])
		{
			if($connection->verifymdp($_GET['mdp']))
			{
				$_Joueur_ = $connection->getReponseConnection();
				$maj = new Maj($_Joueur_, $bddConnection);
				$maj->setNouvellesDonneesMdp($_GET['mdpnouveau']);

				// modif - ok
				$printmessage = 1;
			}
			else
			{
				// modif - le mot de passe est incorrect
				$printmessage = 11;
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