<?php
require_once('modele/joueur/connection.class.php');
require_once('modele/joueur/maj.class.php');

if(isset($_GET['pseudo']) AND isset($_GET['mdp']) AND isset($_GET['email']) AND !empty($_GET['pseudo']) AND !empty($_GET['mdp']) AND !empty($_GET['email']))
{
	$_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
	$_GET['mdp'] = htmlspecialchars($_GET['mdp']);
	$_GET['email'] = htmlspecialchars($_GET['email']);

    $connection = new Connection($_GET['pseudo'], $bddConnection);
    if($connection->verifymdp($_GET['mdp']))
    {
		if(filter_var($_GET['email'], FILTER_VALIDATE_EMAIL))
		{
            $_Joueur_ = $connection->getReponseConnection();
            $maj = new Maj($_Joueur_, $bddConnection);
            $maj->setNouvellesDonneesEmail($_GET['email']);

            // modif - ok
            $printmessage = 1;
        }
        else
        {
            // modif - mail invalide
            $printmessage = 22;
        }
    }
    else
    {
        // modif - le mot de passe est incorrect
		$printmessage = 11;
    }
}
else
{
    // modif - il manque des parametres
	$printmessage = 13;
}
?>