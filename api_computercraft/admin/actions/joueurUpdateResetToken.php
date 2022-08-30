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
			if(isset($_GET['player']) AND !empty($_GET['player']))
			{
				$_GET['player'] = htmlspecialchars($_GET['player']);
				$reqlogin = $bddConnection->prepare('SELECT id FROM liste_users WHERE pseudo = :pseudo'); // verifie que le joueur a modifier existe
				$reqlogin->execute(array(
					'pseudo' => $_GET['player']
				));
				$reqlogin = $reqlogin->fetch(PDO::FETCH_ASSOC);
				if(!empty($reqlogin))
				{
                    if (isset($_GET['newdata']) AND !empty($_GET['newdata']))
                    {
                        $resetToken = md5(microtime(TRUE)*(100000+rand(1,1000)));
                    }
                    else
                    {
                        $resetToken = NULL;
                    }
                    
					$req = $bddConnection->prepare('UPDATE liste_users SET resettoken = :newdata WHERE id = :id_user');
					$req->execute(array(
						'id_user' => $reqlogin["id"],
						'newdata' => $resetToken
					));
					// modif - print(player, token)
					$printmessage = array('player' => $_GET['player'],'token' => urlencode($resetToken));
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