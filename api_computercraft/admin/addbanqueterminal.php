<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');
require_once('class/groupes.class.php');
require_once('class/apikeys.class.php');

if (!Checkdroits::checkArgs($_GET,array('pseudo' => false, 'mdp' => false, 'email' => false, 'nom' => false))) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_GET);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!empty(Joueurs::getJoueurByPseudo($bddConnection, $_GET['pseudo']))) {
    return array('status_code' => 404, 'message' => 'Le pseudo est deja pris.');
}
if (!Checkdroits::checkPasswordSecu($_GET['mdp'])) {
    return array('status_code' => 400, 'message' => 'Le mot de passe doit contenir au moins 8 caracteres, une majuscule, une minuscule et un chiffre.');
}
if (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
    return array('status_code' => 413, 'message' => 'L\'adresse mail est invalide.');
}
if (strlen($_GET['pseudo']) > $_Serveur_['MaxLengthChamps']['Pseudo']) {
    return array('status_code' => 413, 'message' => 'Le pseudo est trop long.');
}
if (strlen($_GET['email']) > $_Serveur_['MaxLengthChamps']['Email']) {
    return array('status_code' => 413, 'message' => 'L\'email est trop long.');
}
$newJoueur = new Joueurs($bddConnection);
$newJoueur->addJoueur($_GET['pseudo'], $_GET['email'], Checkdroits::generatePassword(50), 0, 3); // compte terminal banque
$groupe = new Groupes($bddConnection, 1); // 1 groupe Administrateur
$groupe->addJoueur($newJoueur->getId());
$newApiKey = new ApiKeys($bddConnection);
$newApiKey->addapikey($_GET['nom'], $_GET['mdp'], $newJoueur->getId());
return array('status_code' => 200, 'message' => '', 'data' => array('idJoueur' => $newJoueur->getId(), 'idApiKey' => $newApiKey->getIdApiKey()));