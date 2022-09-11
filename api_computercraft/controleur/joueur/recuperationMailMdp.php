<?php
require_once('modele/joueur/checkToken.class.php');
require_once('modele/joueur/maj.class.php');
require_once('include/phpmailer/MailSender.php');

if(isset($_GET['pseudo']) AND isset($_GET['token']) AND !empty($_GET['pseudo']) AND !empty($_GET['token']))
{
	$_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
	$token = urldecode($_GET['token']);
	$tokenInfos = new checkToken($_GET['pseudo'], $token, $bddConnection);
	$donneesJoueur = $tokenInfos->getReponseConnection();

	if(empty($donneesJoueur))
	{
		// modif - le mot de passe est incorrect
		$printmessage = 11;
	}
	else
	{
		$mdp = genMdp();

		$maj = new Maj($donneesJoueur, $bddConnection);  
		$maj->setNouvellesDonneesResetToken(null);
		$maj = new Maj($donneesJoueur, $bddConnection);  
		$maj->setNouvellesDonneesMdp($mdp);
		
		$retourligne = "<br />";
		
		$to = $donneesJoueur['email'];
		$subject = "[".$_Serveur_['General']['name']."]Confirmation : Recuperation de mot de passe";
		$txt = 'Bonjour, '.$donneesJoueur['pseudo'].$retourligne
				.$retourligne
				.'Vous avez bien confirmé votre demande de changement de mot de passe.'.$retourligne
				.'Voici votre nouveau mot de passe : '.$mdp.$retourligne
				.$retourligne
				.'Merci de changer au plus vite votre mot de passe.'.$retourligne
				.'Il est inutile de répondre à ce mail automatique.'.$retourligne
				.$retourligne
				.'Cordialement, '.$_Serveur_['General']['name'].'.';
	
		
		if(MailSender::send($_Serveur_, $to, $subject, $txt))
		{
			// modif - ok
			$printmessage = 1;
		}
		else
		{
			// modif - le mot de passe est incorrect (code executer si le mail n'a pas pu être envoyer : identifient du serveur smtp incorrect, serveur injoignable, ...)
			$printmessage = 11;
		}
	}
}
else
{
	// modif - il manque des parametres
	$printmessage = 13;
}
function genMdp(){
	$caracAllows = 'ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789';
	return substr(str_shuffle($caracAllows), 0, 7);
}
?>