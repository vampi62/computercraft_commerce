<?php
require_once('modele/joueur/connection.class.php');

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
			if(isset($_GET['player']) AND isset($_GET['newdata']) AND !empty($_GET['player']) AND !empty($_GET['newdata']))
			{
				$_GET['player'] = htmlspecialchars($_GET['player']);
				$_GET['newdata'] = htmlspecialchars($_GET['newdata']);
				$reqlogin = $bddConnection->prepare('SELECT id FROM liste_users WHERE pseudo = :pseudo'); // verifie que le joueur a modifier existe
				$reqlogin->execute(array(
					'pseudo' => $_GET['player']
				));
				$reqlogin = $reqlogin->fetch(PDO::FETCH_ASSOC);
				if(!empty($reqlogin))
				{
					if(filter_var($_GET['newdata'], FILTER_VALIDATE_EMAIL))
					{
						$req = $bddConnection->prepare('UPDATE liste_users SET email = :newdata WHERE id = :id_user');
						$req->execute(array(
							'id_user' => $reqlogin["id"],
							'newdata' => $_GET['newdata']
						));
						// modif - ok
						$printmessage = 1;
					}
					else
					{
						// modif - mail invalide
						$printmessage = 22;
					}
				}
				else
				{
					// modif - login incorrect
					$printmessage = 11;
				}
			}
			else
			{
				// modif - il manque des parametres
				$printmessage = 13;
			}
		}
		else
		{
			// modif - privilege insuffisant
			$printmessage = 10;
		}
	}
	else
	{
		// modif - le mot de passe admin est incorrect
		$printmessage = 12;
	}
}
else
{
	// modif - il manque des parametres
	$printmessage = 13;
}
?>