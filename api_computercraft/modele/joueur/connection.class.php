<?php
class Connection
{
	private $reponseConnection;
	private $bdd;
	
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
		$this->bdd = $bdd;

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
				$this->updateLastLogin();
				return true;
			}
		}
		return false;
	}

	private function updateLastLogin()
	{
		$date = date("Y-m-d");
		$req = $this->bdd->prepare('UPDATE liste_users SET last_login = :last_login WHERE id = :id');
		$req->execute(array(
			'last_login' => $date,
			'id' => $this->reponseConnection['id']
			));
	}
}
?>