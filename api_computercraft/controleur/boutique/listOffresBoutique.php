<?php
require_once('modele/joueur/connection.class.php');
require_once('modele/boutique/boutique.class.php');
require_once('modele/converttable.class.php');
if(isset($_GET['pseudo']) AND isset($_GET['mdp']) AND !empty($_GET['pseudo']) AND !empty($_GET['mdp']) )
{
	$_GET['pseudo'] = htmlspecialchars($_GET['pseudo']);
	$_GET['mdp'] = htmlspecialchars($_GET['mdp']);
	$connection = new Connection($_GET['pseudo'], $bddConnection);
	if($connection->verifymdp($_GET['mdp']))
	{
		$_Joueur_ = $connection->getReponseConnection();
		$boutique = new Boutique($_Joueur_, $bddConnection);
	}
	else
	{
		$player['id']=0;
		$boutique = new Boutique($player, $bddConnection);
	}
}
else
{
	$player['id']=0;
	$boutique = new Boutique($player, $bddConnection);
}
$listeboutique = $boutique->getOffres();
// modif - print $listeboutique
$printmessage = $listeboutique;
?>