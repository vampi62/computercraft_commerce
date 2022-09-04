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
			if(isset($_GET['crediteur']) AND isset($_GET['debiteur']) AND isset($_GET['somme']) AND isset($_GET['type']) AND isset($_GET['description']) AND isset($_GET['statut']) AND !empty($_GET['crediteur']) AND !empty($_GET['debiteur']) AND !empty($_GET['somme']) AND !empty($_GET['type']) AND !empty($_GET['description']) AND !empty($_GET['statut']))
			{
				$_GET['crediteur'] = htmlspecialchars($_GET['crediteur']);
				$_GET['debiteur'] = htmlspecialchars($_GET['debiteur']);
				$_GET['somme'] = htmlspecialchars($_GET['somme']);
				$_GET['type'] = htmlspecialchars($_GET['type']);
				$_GET['description'] = htmlspecialchars($_GET['description']);
				$_GET['statut'] = htmlspecialchars($_GET['statut']);
				$reqlogin = $bddConnection->prepare('SELECT id FROM liste_users WHERE pseudo = :pseudo');
				$reqlogin->execute(array(
					'pseudo' => $_GET['crediteur']
				));
				$reqlogin = $reqlogin->fetch(PDO::FETCH_ASSOC);
				if(!empty($reqlogin))
				{
					$reqlogin2 = $bddConnection->prepare('SELECT id FROM liste_users WHERE pseudo = :pseudo');
					$reqlogin2->execute(array(
						'pseudo' => $_GET['debiteur']
					));
					$reqlogin2 = $reqlogin2->fetch(PDO::FETCH_ASSOC);
					if(!empty($reqlogin2))
					{
						$date = date("Y-m-d");
						$heure = date("H:i:s");
						$req = $bddConnection->prepare('INSERT INTO transactions(id_commandes, id_admin_exec, debiteur, crediteur, somme, type, description, statut, date, heure) VALUES(:id_commandes, :id_admin_exec, :debiteur, :crediteur, :somme, :type, :description, :statut, :date, :heure)');
						$req->execute(array(
							'id_commandes' => 0,
							'id_admin_exec' => $_Joueur_['id'],
							'crediteur' => $reqlogin["id"],
							'debiteur' => $reqlogin2["id"],
							'somme' => $_GET["somme"],
							'type' => $_GET["type"],
							'description' => $_GET["description"],
							'statut' => $_GET["statut"],
							'date' => $date,
							'heure' => $heure
						));
						// modif - ok
						$printmessage = 1;
					}
					else
					{
						// modif - login incorrect
						$printmessage = 11;
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