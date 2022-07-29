<?php
class Inscription
{
	private $bdd;
	
    public function __construct($pseudo, $mdp, $email, $bdd, $_Serveur_)
    {	
		$reponseConnection = $bdd->prepare('INSERT INTO liste_users(pseudo, mdp, email, compte, nbr_offre, role) VALUES(:player, :mdp, :email, 0, :nbr_offre, :rang)');
		$reponseConnection->execute(array(
			'player' => $pseudo,
			'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
			'rang' => 0,
			'email' => $email,
			'nbr_offre' => $_Serveur_['General']['offre_depart']
		));
		$this->bdd = $bdd;
	}
	public function getnewid($pseudo)
	{
		$reponseConnection = $this->bdd->prepare('SELECT id FROM liste_users WHERE pseudo = :pseudo');
		$reponseConnection->execute(array(
			'pseudo' => $pseudo,
			));
		$reponseConnection = $reponseConnection->fetch(PDO::FETCH_ASSOC);
		return $reponseConnection;
	}
}
?>