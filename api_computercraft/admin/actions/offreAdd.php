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
				$reqlogin = $bddConnection->prepare('SELECT id FROM liste_users WHERE pseudo = :pseudo');
				$reqlogin->execute(array(
					'pseudo' => $_GET['player']
				));
				$reqlogin = $reqlogin->fetch(PDO::FETCH_ASSOC);
				if(!empty($reqlogin))
				{
					$date = date("Y-m-d");
					$req = $this->bdd->prepare('INSERT INTO liste_offres(proprio, last_update, prix, nbr_dispo, id_adresse, type, livraison, nom, description) VALUES(:proprio, :last_update, 0, 0, 0, 0, 0, "","")');
					$req->execute(array(
						'proprio' => $reqlogin['id'],
						'last_update' => $date
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