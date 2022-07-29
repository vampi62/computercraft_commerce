<?php
class Maj
{
	private $bdd;
    private $id;
	
    public function __construct($player, $bdd)
    {	
		$this->bdd = $bdd;
		$this->id = $player['id'];
	}
	
	public function setNouvellesDonneesEmail($email)
	{
		$req = $this->bdd->prepare('UPDATE liste_users SET email = :email WHERE id = :id');
		$req->execute(array(
			'email' => $email,
			'id' => $this->id
			));
	}
	public function setNouvellesDonneesMdp($mdp)
	{
		$req = $this->bdd->prepare('UPDATE liste_users SET mdp = :mdp WHERE id = :id');
		$req->execute(array(
			'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
			'id' => $this->id
			));
	}
	public function setNouvellesDonneesCompte($compte)
	{
		$req = $this->bdd->prepare('UPDATE liste_users SET compte = :compte WHERE id = :id');
		$req->execute(array(
			'compte' => $compte,
			'id' => $this->id
		));
	}
	public function setNouvellesDonneesNbrOffre($nbr_offre)
	{
		$req = $this->bdd->prepare('UPDATE liste_users SET nbr_offre = :nbr_offre WHERE id = :id');
		$req->execute(array(
			'nbr_offre' => $nbr_offre,
			'id' => $this->id
		));
	}
}
?>
