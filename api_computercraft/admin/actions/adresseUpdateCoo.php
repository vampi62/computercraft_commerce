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
			if(isset($_GET['newdata']) AND isset($_GET['player']) AND isset($_GET['newtypedata']) AND !empty($_GET['newdata']) AND !empty($_GET['player']) AND !empty($_GET['newtypedata']))
			{
				$_GET['player'] = htmlspecialchars($_GET['player']);
				$_GET['newdata'] = htmlspecialchars($_GET['newdata']);
				$_GET['newtypedata'] = htmlspecialchars($_GET['newtypedata']);

				$req = $bddConnection->prepare('SELECT id FROM liste_adresses WHERE proprio = :pseudo AND nom = :newdata');
				$req->execute(array(
					'pseudo' => $_GET['player'],
					'newdata' => $_GET['newdata']
				));
				$req = $req->fetch(PDO::FETCH_ASSOC);
				
				if(!empty($req["id"]))
				{
					$req2 = $bddConnection->prepare('UPDATE liste_adresses SET coo = :newtypedata WHERE id = :newdata AND proprio = :proprio');
					$req2->execute(array(
						'newdata' => $_GET["newdata"],
						'newtypedata' => $_GET['newtypedata'],
						'proprio' => $_GET['player']
					));
					// modif - ok
					$printmessage = 1;
				}
				else
				{
					// modif - nom adresse inexistant
					$printmessage = 70;
				}
			}
			else
			{
				// il manque des parametres
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