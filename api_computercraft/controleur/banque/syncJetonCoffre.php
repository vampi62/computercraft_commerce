<?php
require_once('modele/joueur/connection.class.php');
require_once('modele/banque/jeton.class.php');

if(isset($_GET['pseudo']) AND isset($_GET['mdp']) AND isset($_GET['jeton1']) AND isset($_GET['jeton10']) AND isset($_GET['jeton100']) AND isset($_GET['jeton1k']) AND isset($_GET['jeton10k']))
{
    if(!empty($_GET['pseudo']) AND !empty($_GET['mdp']))
    {
        $_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
        $_GET['mdp'] = htmlspecialchars($_GET['mdp']);

        $arrayjeton = array();
        $arrayjeton["1"] = htmlspecialchars($_GET['jeton1']);
        $arrayjeton["10"] = htmlspecialchars($_GET['jeton10']);
        $arrayjeton["100"] = htmlspecialchars($_GET['jeton100']);
        $arrayjeton["1k"] = htmlspecialchars($_GET['jeton1k']);
        $arrayjeton["10k"] = htmlspecialchars($_GET['jeton10k']);

        $jetonvalide = true;
        foreach($arrayjeton as $element)
        {
            if (intval($element) < 0)
            {
                $printmessage = 61;
                $jetonvalide = false;
            }
        }
        if ($jetonvalide)
        {
            $connection = new Connection($_GET['pseudo'], $bddConnection);
            if($connection->verifymdp($_GET['mdp']))
            {
                $_Joueur_ = $connection->getReponseConnection();
                $jeton = new Jeton($_Joueur_, $bddConnection);
                if($_Joueur_['role'] == 1)
                {
                    $comptejeton = $jeton->getReponseConnection();
                    if(empty($comptejeton['id_user']))
                    {
                        $jeton->setInitJeton($arrayjeton);
                    }
                    else
                    {
                        $jeton->setSyncJeton($arrayjeton);
                    }
                    // modif - ok
                    $printmessage = 1;
                }
                else
                {
                    // modif - privilege incorrect
                    $printmessage = 10;
                }
            }
            else
            {
                // modif - le mot de passe admin est incorrect
                $printmessage = 12;
            }
        }
    }
    else
    {
        // modif - il manque des parametres
	    $printmessage = 13;
    }
}
else
{
    // modif - il manque des parametres
	$printmessage = 13;
}
?>