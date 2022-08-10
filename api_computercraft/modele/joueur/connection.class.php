<?php
class Connection
{
	private $reponseConnection;
	
	public function __construct($pseudo, $bdd)
	{	
		if (is_int($pseudo))
		{
			$reponseConnection = $bdd->prepare('SELECT * FROM liste_users WHERE id = :pseudo');
		}
		else
		{
			$reponseConnection = $bdd->prepare('SELECT * FROM liste_users WHERE pseudo = :pseudo');
		}
		$reponseConnection->execute(array(
			'pseudo' => $pseudo,
		));
		$reponseConnection = $reponseConnection->fetch(PDO::FETCH_ASSOC);
		$this->reponseConnection = $reponseConnection;

	}
	
	public function getReponseConnection()
	{
		return $this->reponseConnection;
	}

	public function verifymdp($mdp)
	{
		if(!empty($this->reponseConnection))
		{
			if(password_verify($mdp, $this->reponseConnection['mdp']))
			{
				return true;
			}
		}
		return false;
	}
}
?>