<?php
require_once('class/joueurs.class.php');
require_once('include/phpmailer/MailSender.php');
require_once('class/checkdroits.class.php');

if (Checkdroits::CheckArgs($_GET, array('pseudo', 'token'))) {
	$_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
	$token = urldecode($_GET['token']);
	$donneesJoueur = Joueurs::getJoueurByToken($bddConnection, $_GET['pseudo'], $token);
	if(empty($donneesJoueur)) {
		// modif - le mot de passe est incorrect
		$printmessage = array('status_code' => 401, 'message' => 'Le pseudo ou le mail est incorrect.');
	} else {
		$caracAllows = 'ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789';
		$mdp = substr(str_shuffle($caracAllows), 0, 7);

		Joueurs::setResetToken($bddConnection, $donneesJoueur['id_joueur'], null);
		Joueurs::setMdp($bddConnection, $donneesJoueur['id_joueur'], $mdp);
		
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
	
		
		if(MailSender::send($_Serveur_, $to, $subject, $txt)) {
			// modif - ok
			$printmessage = array('status_code' => 200, 'message' => 'Un mail vous a été envoyé avec votre nouveau mot de passe.');
		} else {
			// modif - le mot de passe est incorrect (code executer si le mail n'a pas pu être envoyer : identifient du serveur smtp incorrect, serveur injoignable, ...)
			$printmessage = array('status_code' => 500, 'message' => 'Une erreur est survenue lors de l\'envoi du mail.');
		}
	}
} else {
	// modif - il manque des parametres
	$printmessage = array('status_code' => 400, 'message' => 'Il manque des paramètres.');
}
?>