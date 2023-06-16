<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::CheckArgs($_GET, array('pseudo' => false, 'mdp' => false, 'email' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
if (!empty(Joueurs::getJoueurbyPseudo($bddConnection, $_GET['pseudo']))) {
	return array('status_code' => 404, 'message' => 'Le pseudo est deja pris.');
}
if (!Checkdroits::CheckPasswordSecu($_GET['mdp'])) {
	return array('status_code' => 400, 'message' => 'Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre.');
}
if (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
	return array('status_code' => 413, 'message' => 'L\'adresse mail est invalide.');
}
if (strlen($_GET['pseudo']) > $_Serveur_['MaxLengthChamps']['pseudo']) {
	return array('status_code' => 413, 'message' => 'Le pseudo est trop long.');
}
if (strlen($_GET['email']) > $_Serveur_['MaxLengthChamps']['email']) {
	return array('status_code' => 413, 'message' => 'L\'email est trop long.');
}
$newid = Joueurs::addJoueur($bddConnection, $_GET['pseudo'], $_GET['email'], $_GET['mdp'], $_Serveur_['General']['nbr_offre_defaut'], 1);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $newid));