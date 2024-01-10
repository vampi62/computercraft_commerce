<?php // 2eme etape de la recuperation de mot de passe par email
require_once('class/joueurs.class.php');
require_once('include/phpmailer/MailSender.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_POST, array('pseudo' => false, 'token' => false), true)) {
	// modif - il manque des parametres
	return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$token = urldecode($_POST['token']);
$donneesJoueur = Joueurs::getJoueurByToken($bddConnection, $_POST['pseudo'], $token);
if(empty($donneesJoueur)) {
	// modif - le mot de passe est incorrect
	return array('status_code' => 401, 'message' => 'Le pseudo ou le mail est incorrect.');
}
$caracAllows = 'ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789';
$mdp = substr(str_shuffle($caracAllows), 0, 7);

$joueur = new Joueurs($bddConnection, $donneesJoueur['id_joueur']);

$retourligne = "<br />";

$to = $donneesJoueur['email_joueur'];
$subject = "[".$_Serveur_['General']['Name']."]Confirmation : Recuperation de mot de passe";
$txt = 'Bonjour, '.$donneesJoueur['pseudo_joueur'].$retourligne
		.$retourligne
		.'Vous avez bien confirmé votre demande de changement de mot de passe.'.$retourligne
		.'Voici votre nouveau mot de passe : '.$mdp.$retourligne
		.$retourligne
		.'Merci de changer au plus vite votre mot de passe.'.$retourligne
		.'Il est inutile de répondre à ce mail automatique.'.$retourligne
		.$retourligne
		.'Cordialement, '.$_Serveur_['General']['Name'].'.';


if(MailSender::send($_Serveur_, $to, $subject, $txt)) { // modification du mot de passe que si le mail a pu être envoyer
	$joueur->setJoueurResetToken(null);
	$joueur->setJoueurMdp($mdp);
	// modif - ok
	return array('status_code' => 200, 'message' => 'Un mail vous a ete envoye avec votre nouveau mot de passe.');
} else {
	// modif - le mot de passe est incorrect (code executer si le mail n'a pas pu être envoyer : identifient du serveur smtp incorrect, serveur injoignable, ...)
	return array('status_code' => 500, 'message' => 'Une erreur est survenue lors de l\'envoi du mail.');
}
?>