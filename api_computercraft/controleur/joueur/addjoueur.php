<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_POST,array('pseudo' => false,'mdp' => false,'email' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
if (!empty(Joueurs::getJoueurByPseudo($bddConnection, $_POST['pseudo']))) {
    return array('status_code' => 404, 'message' => 'Le pseudo est deja pris.');
}
if (!Checkdroits::checkPasswordSecu($_POST['mdp'])) {
    return array('status_code' => 400, 'message' => 'Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre.');
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    return array('status_code' => 413, 'message' => 'L\'adresse mail est invalide.');
}
if (strlen($_POST['pseudo']) > $_Serveur_['MaxLengthChamps']['Pseudo']) {
    return array('status_code' => 413, 'message' => 'Le pseudo est trop long.');
}
if (strlen($_POST['email']) > $_Serveur_['MaxLengthChamps']['Email']) {
    return array('status_code' => 413, 'message' => 'L\'email est trop long.');
}
$joueur = new Joueurs($bddConnection, null);
$joueur->addJoueur($_POST['pseudo'], $_POST['email'], $_POST['mdp'], $_Serveur_['General']['NbrOffreDefaut']);
return array('status_code' => 200, 'message' => '', 'data' => array('id' => $joueur->getIdJoueur()));