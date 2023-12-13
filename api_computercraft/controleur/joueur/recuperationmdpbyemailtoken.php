<?php
require_once('class/joueurs.class.php');
require_once('include/phpmailer/MailSender.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_GET, array('pseudo' => false, 'email' => false))) {
	// modif - il manque des parametres
	return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$donneesJoueur = Joueurs::getJoueurByMail($bddConnection, $_GET['pseudo'], $_GET['email']);
if(empty($donneesJoueur)) {
	// modif - le mot de passe est incorrect
	return array('status_code' => 401, 'message' => 'Le pseudo ou le mail est incorrect.');
}

$resetToken = substr(md5(microtime(TRUE)*(100000+rand(1,1000))), 0, -20);
Joueurs::setResetToken($bddConnection, $donneesJoueur['id_joueur'], $resetToken);
$lien = urlencode($resetToken);
$retourligne = "<br />";
$to = $donneesJoueur['email_joueur'];
$subject = "[".$_Serveur_['General']['name']."]Recuperation de mot de passe";
$txt = 'Bonjour, '.$donneesJoueur['pseudo_joueur'].$retourligne
		.$retourligne
		.'Suite à une demande de recuperation de mail, vous recevez ce message.'.$retourligne.$retourligne
		.'Voici votre code de recuperation : '.$lien.$retourligne
		.$retourligne
		.'Enter ce code dans un poste client computercraft.'.$retourligne
		.$retourligne
		.'Si vous n\'avez pas fait de demande de recuperation veuillez ignorer cet e-mail...'.$retourligne
		.'Il est inutile de repondre à ce mail automatique.'.$retourligne
		.$retourligne
		.'Cordialement, '. $_Serveur_['General']['name'] .'.';

if(MailSender::send($_Serveur_, $to, $subject, $txt)) {
	// modif - ok
	return array('status_code' => 200, 'message' => 'Un mail vous a ete envoye.');
} else {
	// modif - le mot de passe est incorrect (code executer si le mail n'a pas pu être envoyer : identifient du serveur smtp incorrect, serveur injoignable, ...)
	return array('status_code' => 500, 'message' => 'Une erreur est survenue lors de l\'envoi du mail.');
}
?>