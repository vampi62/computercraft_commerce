<?php
require_once('modele/joueur/connection.class.php');
require_once('modele/changetext.class.php');
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
			if(isset($_GET['newdata']) AND isset($_GET['player']) AND isset($_GET['newtypedata']) AND !empty($_GET['newdata']) AND !empty($_GET['player']))
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
					$connection2 = new Connection($_GET['player'], $bddConnection);
					$_Joueur_2 = $connection2->getReponseConnection();
					if ($_GET['newtypedata'] == 1)
					{
						if ($req["id"] == $_Joueur_2['id_adresse'])
						{
							// modif - changement type adresse impossible en cours d'utilisation
							$printmessage = 74;
						}
						else
						{
							$req2 = $bddConnection->prepare('UPDATE liste_adresses SET type = :newtypedata WHERE proprio = :proprio AND id = :newdata');
							$req2->execute(array(
								'proprio' => $req["id"],
								'newdata' => $_GET['newdata'],
								'newtypedata' => $_GET['newtypedata']
							));
							// modif - ok
							$printmessage = 1;
						}
					}
					else
					{
						if (ConvertTable::offreUsedId($bddConnection,$req["id"]))
						{
							// modif - changement type adresse impossible en cours d'utilisation
							$printmessage = 74;
						}
						else
						{
							$req2 = $bddConnection->prepare('UPDATE liste_adresses SET type = :newtypedata WHERE proprio = :proprio AND id = :newdata');
							$req2->execute(array(
								'proprio' => $req["id"],
								'newdata' => $_GET['newdata'],
								'newtypedata' => $_GET['newtypedata']
							));
							// modif - ok
							$printmessage = 1;
						}
					}
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