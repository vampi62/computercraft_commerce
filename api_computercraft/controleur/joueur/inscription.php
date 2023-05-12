<?php
require_once('class/joueurs.class.php');
require_once('include/phpmailer/MailSender.php');
require_once('class/checkdroits.class.php');

if(checkdroits::CheckArgs($_GET,array('pseudo','mdp','mdpconfirm','email')))
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
				$donneesJoueur = Joueur::getJoueurbyPseudo($bddConnection, $_GET['pseudo']);
				if(empty($donneesJoueur['pseudo']))
				{
					Joueur::inscription($bddConnection,$_GET['pseudo'], $_GET['email'], $_GET['mdp'], $_Serveur_);
					$printmessage = array('status_code' => 200, 'message' => 'Votre compte a bien été créé.');
					// modif - ok
				}
				else
				{
					// modif - un compte existe deja
					$printmessage = array('status_code' => 403, 'message' => 'Un compte existe déjà avec ce pseudo.');
				}
			}
			else
			{
				// modif - mail invalide
				$printmessage = array('status_code' => 403, 'message' => 'L\'adresse mail est invalide.');
			}
		}
		else
		{
			// modif - le mot de passe n'est pas identique
			$printmessage = array('status_code' => 403, 'message' => 'Les mots de passe ne sont pas identiques.');
		}
	}
	else
	{
		// modif - le mot de passe ne respecte pas les regles de securite
		$printmessage = array('status_code' => 403, 'message' => 'Le mot de passe ne respecte pas les règles de sécurité.');
	}
}
else
{
	// modif - il manque des parametres
	$printmessage = array('status_code' => 400, 'message' => 'Il manque des paramètres.');
}
?>
