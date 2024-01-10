<?php
require_once('class/joueurs.class.php');
require_once('class/checkdroits.class.php');

if (!Checkdroits::checkArgs($_POST,array('id_joueur' => false, 'pseudo' => false), true)) {
    return array('status_code' => 400, 'message' => 'Il manque des parametres.');
}
$sessionAdmin = Checkdroits::checkAdmin($bddConnection,$_POST, true);
if (isset($sessionAdmin['status_code'])) { // si un code d'erreur est retourné par la fonction alors on retourne le code d'erreur
    return $sessionAdmin; // error
}
if (!Checkdroits::checkId($bddConnection, $_POST['id_joueur'], 'joueur')) {
    return array('status_code' => 404, 'message' => 'Le joueur n\'existe pas.');
}
if (!empty(Joueurs::getJoueurByPseudo($bddConnection, $_POST['pseudo']))) {
    return array('status_code' => 400, 'message' => 'Le pseudo est deja utilise.');
}
if (strlen($_POST['pseudo']) > $_Serveur_['MaxLengthChamps']['Pseudo']) {
    return array('status_code' => 413, 'message' => 'Le pseudo est trop long.');
}
$joueur = new Joueurs($bddConnection, $_POST['id_joueur']);
$joueur->setJoueurPseudo($_POST['pseudo']);
return array('status_code' => 200, 'message' => 'Le pseudo a bien ete modifie.');