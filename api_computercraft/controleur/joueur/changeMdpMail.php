<?php
require_once('modele/joueur/mail.class.php');
require_once('modele/joueur/maj.class.php');
require_once('include/phpmailer/MailSender.php');

if(isset($_GET['pseudo']) AND isset($_GET['email']) AND !empty($_GET['pseudo']) AND !empty($_GET['email']))
{
	$_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
	$_GET['email'] = htmlspecialchars($_GET['email']);

	$userConnection = new Mail($_GET['pseudo'],$_GET['email'], $bddConnection);
	$donneesJoueur = $userConnection->getReponseConnection();
	if(empty($donneesJoueur))
	{
		// modif - le mot de passe est incorrect
		$printmessage = 11;
	}
	else
	{
		$resetToken = substr(md5(microtime(TRUE)*(100000+rand(1,1000))), 0, -20);
		$resetToken = $resetToken;
		
		$maj = new Maj($donneesJoueur, $bddConnection);
		$maj->setNouvellesDonneesResetToken($resetToken);

		$lien = urlencode($resetToken);

		$retourligne = "<br />";

		$to = $donneesJoueur['email'];
		$subject = "[computercraft commerce api]Recuperation de mot de passe";
		$txt = 'Bonjour, '.$donneesJoueur['pseudo'].$retourligne
				.$retourligne
				.'Suite à une demande de récupération de mail, vous recevez ce message.'.$retourligne.$retourligne
				.'Voici votre code de récupération : '.$lien.$retourligne
				.$retourligne
				.'Enter ce code dans un poste client computercraft.'.$retourligne
				.$retourligne
				.'Si vous n\'avez pas fait de demande de récupération veuillez ignorer cet e-mail...'.$retourligne
				.'Il est inutile de répondre à ce mail automatique.'.$retourligne
				.$retourligne
				.'Cordialement, '. $_Serveur_['General']['name'] .'.';

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
?>