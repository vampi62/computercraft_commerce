<?php
class Inscription
{
	private $bdd;
	private $id;
	
	public function __construct($pseudo, $mdp, $email, $bdd)
	{	
		$req = $bdd->prepare('INSERT INTO liste_users(pseudo, mdp, email, compte, nbr_offre, id_adresse, role) VALUES(:player, :mdp, :email, 0, 0, 0, 0)');
		$req->execute(array(
			'player' => $pseudo,
			'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
			'email' => $email
		));
		$this->bdd = $bdd;
	}
	public function getnewid($pseudo)
	{
		$req = $this->bdd->prepare('SELECT id FROM liste_users WHERE pseudo = :pseudo');
		$req->execute(array(
			'pseudo' => $pseudo,
			));
		$req = $req->fetch(PDO::FETCH_ASSOC);
		$this->id = $req['id'];
		return $req;
	}
	public function setNbrOffre($nbr_offre)
	{
		$req = $this->bdd->prepare('UPDATE liste_users SET nbr_offre = :nbr_offre WHERE id = :id');
		$req->execute(array(
			'nbr_offre' => $nbr_offre["COUNT(id)"],
			'id' => $this->id
		));
	}
}
?>